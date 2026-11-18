<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Workshop;
use App\Models\Registration;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik utama
        $totalParticipants = User::where('is_admin', false)->count();

        $totalRegistrations = Registration::count();

        $totalTickets = Registration::where('status', 'paid')->count();

        $totalRevenue = Registration::where('status', 'paid')
            ->sum('amount');

        $totalWorkshops = Workshop::count();

        $pendingPayments = Registration::where('status', 'pending')
            ->count();

        // Pendaftaran terbaru
        $latestRegistrations = Registration::with([
            'user',
            'workshop'
        ])
            ->latest()
            ->take(5)
            ->get();

        // Grafik pendaftaran selama 12 bulan
        $monthlyData = Registration::selectRaw(
            'MONTH(created_at) as month, COUNT(*) as total'
        )
            ->whereYear('created_at', now()->year)
            ->groupByRaw('MONTH(created_at)')
            ->pluck('total', 'month');

        $monthlyLabels = [
            'Jan', 'Feb', 'Mar', 'Apr',
            'Mei', 'Jun', 'Jul', 'Agu',
            'Sep', 'Okt', 'Nov', 'Des'
        ];

        $monthlyRegistrations = [];

        for ($i = 1; $i <= 12; $i++) {
            $monthlyRegistrations[] = (int) ($monthlyData[$i] ?? 0);
        }

        // Statistik kategori workshop
        $categoryStats = Registration::join(
            'workshops',
            'registrations.workshop_id',
            '=',
            'workshops.id'
        )
            ->selectRaw('workshops.category, COUNT(*) as total')
            ->groupBy('workshops.category')
            ->pluck('total', 'category');

        return view('admin.dashboard', compact(
            'totalParticipants',
            'totalRegistrations',
            'totalTickets',
            'totalRevenue',
            'totalWorkshops',
            'pendingPayments',
            'latestRegistrations',
            'monthlyLabels',
            'monthlyRegistrations',
            'categoryStats'
        ));
    }
}
