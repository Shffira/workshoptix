
@extends('layouts.admin')

@section('title', 'Data Peserta')
@section('page-title', 'Data Peserta')

@section('content')

<div class="card">
    <div class="card-header">
        <h2>Daftar Peserta</h2>
        <span>{{ $participants->total() }} Peserta</span>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Nama Peserta</th>
                    <th>Email</th>
                    <th>No. Telepon</th>
                    <th>Total Pendaftaran</th>
                    <th>Bergabung</th>
                </tr>
            </thead>

            <tbody>
                @forelse($participants as $participant)
                    <tr>
                        <td>{{ $participant->name }}</td>
                        <td>{{ $participant->email }}</td>
                        <td>{{ $participant->phone ?? '-' }}</td>
                        <td>{{ $participant->registrations_count }}</td>
                        <td>{{ $participant->created_at->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align:center; padding:30px;">
                            Belum ada peserta.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{ $participants->links('components.pagination') }}

@endsection
