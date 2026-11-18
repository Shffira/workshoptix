<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RegistrationController extends Controller
{
    /**
     * Show participant's registration list.
     */
    public function index()
    {
        $registrations = auth()->user()
            ->registrations()
            ->with('workshop')
            ->latest()
            ->get();

        return view('registrations.index', compact('registrations'));
    }

    /**
     * Store a new registration (checkout).
     */
    public function store(Request $request, Workshop $workshop)
    {
        $user = auth()->user();

        // Prevent duplicate registration
        $existing = Registration::where('user_id', $user->id)
            ->where('workshop_id', $workshop->id)
            ->where('status', '!=', 'cancelled')
            ->first();

        if ($existing) {
            return redirect()->route('registrations.show', $existing)
                ->with('info', 'Anda sudah terdaftar di workshop ini.');
        }

        // Check quota
        $registered = $workshop->registrations()->where('status', '!=', 'cancelled')->count();
        if ($registered >= $workshop->quota) {
            return back()->with('error', 'Maaf, kuota workshop sudah penuh.');
        }

        // Create registration
        $registration = Registration::create([
            'user_id' => $user->id,
            'workshop_id' => $workshop->id,
            'amount' => $workshop->price,
            'status' => 'pending',
        ]);

        // Create Midtrans Snap Token
        $snapToken = $this->createSnapToken($registration, $user, $workshop);

        if ($snapToken) {
            $registration->update(['snap_token' => $snapToken]);
        }

        return redirect()->route('registrations.show', $registration)
            ->with('success', 'Pendaftaran berhasil. Silakan selesaikan pembayaran.');
    }

    /**
     * Show a single registration / payment page.
     */
    public function show(Registration $registration)
    {
        // Only allow owner
        if ($registration->user_id !== auth()->id()) {
            abort(403);
        }

        $registration->load('workshop');

        return view('registrations.show', compact('registration'));
    }

    /**
     * Show digital ticket (only if paid).
     */
    public function ticket(Registration $registration)
    {
        if ($registration->user_id !== auth()->id()) {
            abort(403);
        }

        if (! $registration->isPaid()) {
            return redirect()->route('registrations.show', $registration)
                ->with('error', 'Tiket hanya tersedia setelah pembayaran terverifikasi.');
        }

        $registration->load('workshop', 'user');

        return view('registrations.ticket', compact('registration'));
    }

    /**
     * Handle Midtrans payment notification (webhook).
     */
    public function notification(Request $request)
    {
        $serverKey = config('services.midtrans.server_key');
        $payload = $request->all();

        // Verify signature
        $signatureKey = hash('sha512',
            $payload['order_id'] .
            $payload['status_code'] .
            $payload['gross_amount'] .
            $serverKey
        );

        if ($signatureKey !== $payload['signature_key']) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $registration = Registration::where('payment_id', $payload['order_id'])
            ->orWhere('id', str_replace('WTX-ORDER-', '', $payload['order_id']))
            ->first();

        if (! $registration) {
            return response()->json(['message' => 'Registration not found'], 404);
        }

        $transactionStatus = $payload['transaction_status'];
        $fraudStatus = $payload['fraud_status'] ?? null;

        if ($transactionStatus === 'capture' && $fraudStatus === 'accept') {
            $registration->markAsPaid($payload['transaction_id'] ?? $payload['order_id']);
        } elseif ($transactionStatus === 'settlement') {
            $registration->markAsPaid($payload['transaction_id'] ?? $payload['order_id']);
        } elseif (in_array($transactionStatus, ['cancel', 'deny', 'expire'])) {
            $registration->update(['status' => 'cancelled']);
        }

        return response()->json(['message' => 'OK']);
    }

    /**
     * Handle payment success callback from Midtrans.
     */
    public function paymentSuccess(Request $request, Registration $registration)
    {
        if ($registration->user_id !== auth()->id()) {
            abort(403);
        }

        // Check payment status via Midtrans API
        $this->checkPaymentStatus($registration);

        $registration->refresh();

        if ($registration->isPaid()) {
            return redirect()->route('registrations.ticket', $registration)
                ->with('success', 'Pembayaran berhasil! Tiket digital Anda sudah tersedia.');
        }

        return redirect()->route('registrations.show', $registration)
            ->with('info', 'Pembayaran sedang diproses. Silakan cek kembali dalam beberapa menit.');
    }

    /**
     * Create Midtrans Snap token.
     */
    private function createSnapToken(Registration $registration, $user, Workshop $workshop): ?string
    {
        $serverKey = config('services.midtrans.server_key');
        $isProduction = config('services.midtrans.is_production', false);

        $baseUrl = $isProduction
            ? 'https://app.midtrans.com/snap/v1/transactions'
            : 'https://app.sandbox.midtrans.com/snap/v1/transactions';

        $orderId = 'WTX-ORDER-' . $registration->id;
        $registration->update(['payment_id' => $orderId]);

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $registration->amount,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone ?? '',
            ],
            'item_details' => [
                [
                    'id' => 'WORKSHOP-' . $workshop->id,
                    'price' => $workshop->price,
                    'quantity' => 1,
                    'name' => $workshop->title,
                ],
            ],
        ];

        try {
            $response = Http::withBasicAuth($serverKey, '')
                ->post($baseUrl, $params);

            if ($response->successful()) {
                return $response->json('token');
            }
        } catch (\Exception $e) {
            \Log::error('Midtrans Snap Token Error: ' . $e->getMessage());
        }

        return null;
    }

    /**
     * Check payment status from Midtrans.
     */
    private function checkPaymentStatus(Registration $registration): void
    {
        if ($registration->isPaid() || ! $registration->payment_id) {
            return;
        }

        $serverKey = config('services.midtrans.server_key');
        $isProduction = config('services.midtrans.is_production', false);

        $baseUrl = $isProduction
            ? "https://api.midtrans.com/v2/{$registration->payment_id}/status"
            : "https://api.sandbox.midtrans.com/v2/{$registration->payment_id}/status";

        try {
            $response = Http::withBasicAuth($serverKey, '')->get($baseUrl);

            if ($response->successful()) {
                $data = $response->json();
                $status = $data['transaction_status'] ?? null;
                $fraud = $data['fraud_status'] ?? null;

                if ($status === 'settlement' || ($status === 'capture' && $fraud === 'accept')) {
                    $registration->markAsPaid($data['transaction_id'] ?? $registration->payment_id);
                }
            }
        } catch (\Exception $e) {
            \Log::error('Midtrans Status Check Error: ' . $e->getMessage());
        }
    }
}
