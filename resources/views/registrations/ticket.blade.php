@extends('layouts.app')

@section('title', 'Tiket Digital - ' . $registration->ticket_code)

@push('styles')
<style>
    @media print {
        .navbar, footer, .no-print { display: none !important; }
        body { background: white; }
        .ticket-wrapper { padding: 0; }
    }

    .ticket-wrapper {
        max-width: 680px;
        margin: 0 auto;
        padding: 32px 24px;
    }

    .ticket {
        background: var(--color-white);
        border: 1px solid var(--color-gray-200);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: var(--shadow-lg);
    }

    .ticket-header {
        background: var(--color-primary);
        padding: 28px 32px;
        color: white;
    }

    .ticket-header .brand {
        font-size: 13px;
        font-weight: 600;
        letter-spacing: 2px;
        text-transform: uppercase;
        opacity: 0.8;
        margin-bottom: 8px;
    }

    .ticket-header .workshop-title {
        font-size: 22px;
        font-weight: 700;
        line-height: 1.3;
        letter-spacing: -0.5px;
    }

    .ticket-header .category-badge {
        display: inline-block;
        margin-top: 10px;
        padding: 3px 10px;
        background: rgba(255,255,255,0.2);
        border-radius: 999px;
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .ticket-divider {
        display: flex;
        align-items: center;
        position: relative;
        background: var(--color-gray-50);
        border-top: 1px dashed var(--color-gray-300);
        border-bottom: 1px dashed var(--color-gray-300);
    }

    .ticket-divider::before {
        content: '';
        position: absolute;
        left: -1px;
        width: 20px;
        height: 20px;
        background: var(--color-gray-100);
        border: 1px solid var(--color-gray-200);
        border-radius: 50%;
        top: 50%;
        transform: translateY(-50%);
    }

    .ticket-divider::after {
        content: '';
        position: absolute;
        right: -1px;
        width: 20px;
        height: 20px;
        background: var(--color-gray-100);
        border: 1px solid var(--color-gray-200);
        border-radius: 50%;
        top: 50%;
        transform: translateY(-50%);
    }

    .ticket-code-section {
        padding: 16px 32px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .ticket-code-label {
        font-size: 10px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--color-gray-400);
        margin-bottom: 4px;
    }

    .ticket-code-value {
        font-size: 22px;
        font-weight: 800;
        color: var(--color-gray-900);
        letter-spacing: 3px;
        font-family: 'Courier New', monospace;
    }

    .ticket-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--color-green-50);
        border: 1px solid var(--color-green-100);
        color: var(--color-green-700);
        padding: 6px 14px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 600;
    }

    .ticket-status::before {
        content: '';
        width: 7px;
        height: 7px;
        background: var(--color-green-500);
        border-radius: 50%;
        display: inline-block;
    }

    .ticket-body {
        padding: 24px 32px;
    }

    .ticket-info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 24px;
    }

    .ticket-info-item .label {
        font-size: 10px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--color-gray-400);
        margin-bottom: 4px;
    }

    .ticket-info-item .value {
        font-size: 14px;
        font-weight: 600;
        color: var(--color-gray-800);
    }

    .ticket-footer {
        background: var(--color-gray-50);
        border-top: 1px solid var(--color-gray-200);
        padding: 16px 32px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .ticket-footer .participant-name {
        font-size: 13px;
        color: var(--color-gray-500);
    }

    .ticket-footer .participant-name strong {
        color: var(--color-gray-800);
        font-weight: 600;
    }

    .ticket-footer .payment-info {
        text-align: right;
        font-size: 12px;
        color: var(--color-gray-500);
    }

    .ticket-footer .amount {
        font-size: 15px;
        font-weight: 700;
        color: var(--color-primary);
    }

    .qr-placeholder {
        width: 100px;
        height: 100px;
        border: 2px solid var(--color-gray-200);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        gap: 4px;
    }

    .qr-grid {
        display: grid;
        grid-template-columns: repeat(7, 10px);
        gap: 2px;
    }

    .qr-cell {
        width: 10px;
        height: 10px;
        border-radius: 1px;
    }
</style>
@endpush

@section('content')
<div class="ticket-wrapper">
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;" class="no-print">
        <a href="{{ route('registrations.index') }}" style="font-size: 13px; color: var(--color-gray-500); font-weight: 500;">
            &larr; Kembali
        </a>
        <button onclick="window.print()" class="btn btn-outline btn-sm">
            Cetak Tiket
        </button>
    </div>

    <div class="ticket">
        {{-- Ticket Header --}}
        <div class="ticket-header">
            <div class="brand">WorkshopTix</div>
            <div class="workshop-title">{{ $registration->workshop->title }}</div>
            <div class="category-badge">{{ $registration->workshop->category }}</div>
        </div>

        {{-- Ticket Code Row --}}
        <div class="ticket-divider">
            <div class="ticket-code-section" style="width: 100%;">
                <div>
                    <div class="ticket-code-label">Kode Tiket</div>
                    <div class="ticket-code-value">{{ $registration->ticket_code }}</div>
                </div>
                <div class="ticket-status">Terverifikasi</div>
            </div>
        </div>

        {{-- Ticket Body --}}
        <div class="ticket-body">
            <div class="ticket-info-grid">
                <div class="ticket-info-item">
                    <div class="label">Pembicara</div>
                    <div class="value">{{ $registration->workshop->speaker }}</div>
                </div>
                <div class="ticket-info-item">
                    <div class="label">Kategori</div>
                    <div class="value">{{ $registration->workshop->category }}</div>
                </div>
                <div class="ticket-info-item">
                    <div class="label">Tanggal</div>
                    <div class="value">{{ $registration->workshop->start_at->format('d F Y') }}</div>
                </div>
                <div class="ticket-info-item">
                    <div class="label">Waktu</div>
                    <div class="value">{{ $registration->workshop->start_at->format('H:i') }} - {{ $registration->workshop->end_at->format('H:i') }} WIB</div>
                </div>
                <div class="ticket-info-item" style="grid-column: span 2;">
                    <div class="label">Lokasi</div>
                    <div class="value">{{ $registration->workshop->location }}</div>
                </div>
            </div>

            <div style="background: var(--color-gray-50); border-radius: var(--radius); padding: 14px 16px; border: 1px solid var(--color-gray-200);">
                <p style="font-size: 12px; color: var(--color-gray-500); line-height: 1.6;">
                    Harap tunjukkan tiket ini kepada panitia saat check-in. Tiket ini berlaku satu kali dan tidak dapat dipindahtangankan.
                </p>
            </div>
        </div>

        {{-- Ticket Footer --}}
        <div class="ticket-footer">
            <div>
                <div class="participant-name">Atas nama: <strong>{{ $registration->user->name }}</strong></div>
                <div style="font-size: 11px; color: var(--color-gray-400); margin-top: 2px;">{{ $registration->user->email }}</div>
                <div style="font-size: 11px; color: var(--color-gray-400); margin-top: 1px;">
                    Dibayar: {{ $registration->paid_at->format('d M Y') }}
                </div>
            </div>
            <div class="payment-info">
                <div>Total Dibayar</div>
                <div class="amount">Rp {{ number_format($registration->amount, 0, ',', '.') }}</div>
            </div>
        </div>
    </div>

    <div style="text-align: center; margin-top: 20px;" class="no-print">
        <p style="font-size: 12px; color: var(--color-gray-400);">
            Tiket ini diterbitkan oleh WorkshopTix &middot; Simpan sebagai bukti pembayaran Anda
        </p>
    </div>
</div>
@endsection
