@extends('layouts.admin')

@section('title', 'Peserta - ' . $workshop->title)
@section('page-title', 'Peserta Workshop')

@section('content')
<div style="margin-bottom: 20px;">
    <a href="{{ route('admin.workshops.index') }}" style="font-size: 13px; color: var(--color-gray-500);">&larr; Kembali ke daftar workshop</a>
</div>

<div class="card" style="margin-bottom: 20px;">
    <div class="card-body" style="padding: 20px 24px;">
        <div class="grid-2">
            <div>
                <div style="font-size: 11px; color: var(--color-gray-400); margin-bottom: 4px;">Workshop</div>
                <div style="font-weight: 600; color: var(--color-gray-900); font-size: 15px;">{{ $workshop->title }}</div>
                <div style="font-size: 12px; color: var(--color-gray-500); margin-top: 2px;">{{ $workshop->speaker }} &middot; {{ $workshop->category }}</div>
            </div>
            <div>
                <div style="font-size: 11px; color: var(--color-gray-400); margin-bottom: 4px;">Tanggal</div>
                <div style="font-weight: 500; font-size: 13px; color: var(--color-gray-700);">{{ $workshop->start_at->format('d F Y, H:i') }} WIB</div>
                <div style="font-size: 12px; color: var(--color-gray-500); margin-top: 2px;">{{ $workshop->location }}</div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h2>Daftar Peserta</h2>
        <span style="font-size: 12px; color: var(--color-gray-500);">{{ $registrations->total() }} peserta</span>
    </div>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Peserta</th>
                    <th>Kode Tiket</th>
                    <th>Status</th>
                    <th>Tanggal Daftar</th>
                    <th>Tanggal Bayar</th>
                </tr>
            </thead>
            <tbody>
                @forelse($registrations as $registration)
                    <tr>
                        <td>
                            <div style="font-weight: 500; color: var(--color-gray-900);">{{ $registration->user->name }}</div>
                            <div style="font-size: 11px; color: var(--color-gray-400);">{{ $registration->user->email }}</div>
                        </td>
                        <td><code style="font-size: 11px; background: var(--color-gray-100); padding: 2px 6px; border-radius: 4px;">{{ $registration->ticket_code }}</code></td>
                        <td>
                            @if($registration->status === 'paid')
                                <span class="badge badge-green">Lunas</span>
                            @elseif($registration->status === 'pending')
                                <span class="badge badge-yellow">Pending</span>
                            @else
                                <span class="badge badge-red">Batal</span>
                            @endif
                        </td>
                        <td style="font-size: 12px; color: var(--color-gray-500);">{{ $registration->created_at->format('d M Y, H:i') }}</td>
                        <td style="font-size: 12px; color: var(--color-gray-500);">
                            {{ $registration->paid_at ? $registration->paid_at->format('d M Y, H:i') : '-' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; color: var(--color-gray-400); padding: 32px;">Belum ada peserta yang mendaftar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{ $registrations->links('components.pagination') }}
@endsection
