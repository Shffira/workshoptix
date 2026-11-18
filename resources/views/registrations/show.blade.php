@extends('layouts.app')

@section('title', 'Detail Pendaftaran')

@push('styles')
<style>
    .payment-box {
        background: var(--color-white);
        border: 1px solid var(--color-gray-200);
        border-radius: var(--radius-lg);
        overflow: hidden;
    }
</style>
@endpush

@section('content')
<div class="container" style="padding-top: 32px; max-width: 760px;">
    <div style="margin-bottom: 20px;">
        <a href="{{ route('registrations.index') }}" style="font-size: 13px; color: var(--color-gray-500); font-weight: 500;">
            &larr; Kembali ke pendaftaran saya
        </a>
    </div>

    <div class="card" style="margin-bottom: 20px;">
        <div class="card-header">
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <h1 style="font-size: 16px; font-weight: 600; color: var(--color-gray-900);">Detail Pendaftaran</h1>
                @if($registration->status === 'paid')
                    <span class="badge badge-green">Lunas</span>
                @elseif($registration->status === 'pending')
                    <span class="badge badge-yellow">Menunggu Pembayaran</span>
                @else
                    <span class="badge badge-red">Dibatalkan</span>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div>
                    <div style="font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: var(--color-gray-400); margin-bottom: 4px;">Kode Tiket</div>
                    <code style="font-size: 15px; font-weight: 700; color: var(--color-gray-900); letter-spacing: 1px;">{{ $registration->ticket_code }}</code>
                </div>
                <div>
                    <div style="font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: var(--color-gray-400); margin-bottom: 4px;">Tanggal Daftar</div>
                    <div style="font-size: 13px; color: var(--color-gray-700); font-weight: 500;">{{ $registration->created_at->format('d F Y, H:i') }} WIB</div>
                </div>
            </div>

            <div style="border-top: 1px solid var(--color-gray-100); padding-top: 20px;">
                <div style="font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: var(--color-gray-400); margin-bottom: 10px;">Informasi Workshop</div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <div>
                        <div style="font-size: 11px; color: var(--color-gray-400); margin-bottom: 2px;">Judul</div>
                        <div style="font-size: 13px; font-weight: 500; color: var(--color-gray-800);">{{ $registration->workshop->title }}</div>
                    </div>
                    <div>
                        <div style="font-size: 11px; color: var(--color-gray-400); margin-bottom: 2px;">Pembicara</div>
                        <div style="font-size: 13px; font-weight: 500; color: var(--color-gray-800);">{{ $registration->workshop->speaker }}</div>
                    </div>
                    <div>
                        <div style="font-size: 11px; color: var(--color-gray-400); margin-bottom: 2px;">Tanggal</div>
                        <div style="font-size: 13px; font-weight: 500; color: var(--color-gray-800);">{{ $registration->workshop->start_at->format('d F Y') }}</div>
                    </div>
                    <div>
                        <div style="font-size: 11px; color: var(--color-gray-400); margin-bottom: 2px;">Waktu</div>
                        <div style="font-size: 13px; font-weight: 500; color: var(--color-gray-800);">{{ $registration->workshop->start_at->format('H:i') }} - {{ $registration->workshop->end_at->format('H:i') }} WIB</div>
                    </div>
                    <div>
                        <div style="font-size: 11px; color: var(--color-gray-400); margin-bottom: 2px;">Lokasi</div>
                        <div style="font-size: 13px; font-weight: 500; color: var(--color-gray-800);">{{ $registration->workshop->location }}</div>
                    </div>
                    <div>
                        <div style="font-size: 11px; color: var(--color-gray-400); margin-bottom: 2px;">Total Bayar</div>
                        <div style="font-size: 15px; font-weight: 700; color: var(--color-primary);">Rp {{ number_format($registration->amount, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($registration->status === 'paid')
        <div class="alert alert-success" style="display: flex; align-items: center; justify-content: space-between; gap: 16px;">
            <div>
                <div style="font-weight: 600; margin-bottom: 2px;">Pembayaran Berhasil</div>
                <div style="font-size: 12px;">Dibayar pada {{ $registration->paid_at->format('d F Y, H:i') }} WIB</div>
            </div>
            <a href="{{ route('registrations.ticket', $registration) }}" class="btn btn-success btn-sm" style="white-space: nowrap;">
                Lihat Tiket Digital
            </a>
        </div>
    @elseif($registration->status === 'pending' && $registration->snap_token)
        <div class="card">
            <div class="card-body" style="text-align: center; padding: 32px 24px;">
                <h2 style="font-size: 16px; font-weight: 600; color: var(--color-gray-900); margin-bottom: 6px;">Selesaikan Pembayaran</h2>
                <p style="font-size: 13px; color: var(--color-gray-500); margin-bottom: 20px;">
                    Total yang harus dibayar: <strong style="color: var(--color-primary);">Rp {{ number_format($registration->amount, 0, ',', '.') }}</strong>
                </p>

                <button id="pay-button" class="btn btn-primary btn-lg">
                    Bayar Sekarang
                </button>

                <p style="font-size: 11px; color: var(--color-gray-400); margin-top: 12px;">
                    Pembayaran aman diproses oleh Midtrans
                </p>
            </div>
        </div>

        <div style="margin-top: 12px; text-align: center;">
            <a href="{{ route('registrations.payment-success', $registration) }}" style="font-size: 13px; color: var(--color-gray-500);">
                Sudah bayar? Klik di sini untuk memeriksa status
            </a>
        </div>
    @elseif($registration->status === 'pending')
        <div class="alert alert-warning">
            Sistem pembayaran belum dapat diproses saat ini. Silakan hubungi panitia.
        </div>
    @endif
</div>
@endsection

@if($registration->status === 'pending' && $registration->snap_token)
@push('scripts')
<script src="{{ config('services.midtrans.snap_url') }}" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
<script>
    document.getElementById('pay-button').addEventListener('click', function() {
        snap.pay('{{ $registration->snap_token }}', {
            onSuccess: function(result) {
                window.location.href = '{{ route('registrations.payment-success', $registration) }}';
            },
            onPending: function(result) {
                alert('Pembayaran menunggu konfirmasi.');
            },
            onError: function(result) {
                alert('Pembayaran gagal. Silakan coba lagi.');
            },
            onClose: function() {
                // User closed the popup
            }
        });
    });
</script>
@endpush
@endif
