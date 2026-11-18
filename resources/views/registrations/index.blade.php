@extends('layouts.app')

@section('title', 'Pendaftaran Saya')

@section('content')
<div class="container">
    <div class="page-header">
        <h1 class="page-title">Pendaftaran Saya</h1>
        <p class="page-subtitle">Daftar workshop yang telah Anda daftarkan</p>
    </div>

    @if($registrations->isEmpty())
        <div class="card">
            <div class="card-body" style="text-align: center; padding: 60px 24px;">
                <p style="color: var(--color-gray-400); font-size: 15px; margin-bottom: 16px;">Anda belum mendaftar ke workshop apapun.</p>
                <a href="{{ route('workshops.index') }}" class="btn btn-primary">Lihat Workshop</a>
            </div>
        </div>
    @else
        <div class="card">
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Workshop</th>
                            <th>Kode Tiket</th>
                            <th>Tanggal</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registrations as $registration)
                            <tr>
                                <td>
                                    <div style="font-weight: 500; color: var(--color-gray-900);">{{ $registration->workshop->title }}</div>
                                    <div style="font-size: 12px; color: var(--color-gray-500);">{{ $registration->workshop->speaker }}</div>
                                </td>
                                <td>
                                    <code style="font-size: 12px; background: var(--color-gray-100); padding: 3px 8px; border-radius: 4px; color: var(--color-gray-700);">{{ $registration->ticket_code }}</code>
                                </td>
                                <td style="font-size: 13px; color: var(--color-gray-600);">
                                    {{ $registration->workshop->start_at->format('d M Y') }}
                                </td>
                                <td style="font-weight: 500;">
                                    Rp {{ number_format($registration->amount, 0, ',', '.') }}
                                </td>
                                <td>
                                    @if($registration->status === 'paid')
                                        <span class="badge badge-green">Lunas</span>
                                    @elseif($registration->status === 'pending')
                                        <span class="badge badge-yellow">Menunggu Pembayaran</span>
                                    @else
                                        <span class="badge badge-red">Dibatalkan</span>
                                    @endif
                                </td>
                                <td>
                                    <div style="display: flex; gap: 6px;">
                                        @if($registration->status === 'paid')
                                            <a href="{{ route('registrations.ticket', $registration) }}" class="btn btn-success btn-sm">
                                                Lihat Tiket
                                            </a>
                                        @elseif($registration->status === 'pending')
                                            <a href="{{ route('registrations.show', $registration) }}" class="btn btn-primary btn-sm">
                                                Bayar
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection
