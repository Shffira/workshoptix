
@extends('layouts.admin')

@section('title', 'Tiket Digital')
@section('page-title', 'Tiket Digital')

@section('content')

<div class="card">
    <div class="card-header">
        <h2>Daftar Tiket Terbit</h2>
        <span>{{ $tickets->total() }} Tiket</span>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Kode Tiket</th>
                    <th>Peserta</th>
                    <th>Workshop</th>
                    <th>Tanggal Terbit</th>
                    <th>Status</th>
                    <th>Detail</th>
                </tr>
            </thead>

            <tbody>
                @forelse($tickets as $ticket)
                    <tr>
                        <td>
                            <code>{{ $ticket->ticket_code }}</code>
                        </td>
                        <td>{{ $ticket->user->name }}</td>
                        <td>{{ $ticket->workshop->title }}</td>
                        <td>
                            {{ $ticket->paid_at?->format('d M Y') ?? '-' }}
                        </td>
                        <td>
                            <span class="badge badge-green">Aktif</span>
                        </td>
                        <td>
                            <a href="{{ route('admin.registrations.show', $ticket) }}"
                               class="btn btn-outline btn-sm">
                                Lihat
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align:center; padding:30px;">
                            Belum ada tiket diterbitkan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{ $tickets->links('components.pagination') }}

@endsection
