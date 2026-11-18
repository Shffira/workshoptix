@extends('layouts.admin')

@section('title', 'Semua Pendaftaran')
@section('page-title', 'Semua Pendaftaran')
@section('page-description', 'Pantau seluruh pendaftaran peserta workshop.')
@section('content')
<div class="card">
    <div class="card-header">
        <h2>Daftar Pendaftaran</h2>
        <span style="font-size: 12px; color: var(--color-gray-500);">{{ $registrations->total() }} total</span>
    </div>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Peserta</th>
                    <th>Workshop</th>
                    <th>Kode Tiket</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                    <th>Tanggal Daftar</th>
                </tr>
            </thead>
            <tbody>
                @forelse($registrations as $registration)
                    <tr>
                        <td>
                            <div style="font-weight: 500; color: var(--color-gray-900);">{{ $registration->user->name }}</div>
                            <div style="font-size: 11px; color: var(--color-gray-400);">{{ $registration->user->email }}</div>
                        </td>
                        <td style="max-width: 180px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; color: var(--color-gray-700);">{{ $registration->workshop->title }}</td>
                        <td><code style="font-size: 11px; background: var(--color-gray-100); padding: 2px 6px; border-radius: 4px;">{{ $registration->ticket_code }}</code></td>
                        <td style="font-weight: 600; color: var(--color-primary); font-size: 13px;">Rp {{ number_format($registration->amount, 0, ',', '.') }}</td>
                        <td>
                            @if($registration->status === 'paid')
                                <span class="badge badge-green">Lunas</span>
                            @elseif($registration->status === 'pending')
                                <span class="badge badge-yellow">Pending</span>
                            @else
                                <span class="badge badge-red">Batal</span>
                            @endif
                        </td>
                        <td style="font-size: 12px; color: var(--color-gray-500);">{{ $registration->created_at->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; color: var(--color-gray-400); padding: 40px;">Belum ada pendaftaran.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{ $registrations->links('components.pagination') }}
@endsection
