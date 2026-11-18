@extends('layouts.admin')

@section('title', 'Daftar Workshop')
@section('page-title', 'Daftar Workshop')
@section('page-description', 'Kelola seluruh informasi dan jadwal workshop.')
@section('content')
<div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
    <div>
        <div style="font-size: 11px; color: var(--color-gray-500);">{{ $workshops->total() }} workshop ditemukan</div>
    </div>
    <a href="{{ route('admin.workshops.create') }}" class="btn btn-primary">Tambah Workshop</a>
</div>

<div class="card">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Workshop</th>
                    <th>Tanggal</th>
                    <th>Harga</th>
                    <th>Peserta</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($workshops as $workshop)
                    <tr>
                        <td>
                            <div style="font-weight: 500; color: var(--color-gray-900);">{{ $workshop->title }}</div>
                            <div style="font-size: 11px; color: var(--color-gray-400);">{{ $workshop->speaker }} &middot; {{ $workshop->category }}</div>
                        </td>
                        <td style="font-size: 12px; color: var(--color-gray-600);">
                            {{ $workshop->start_at->format('d M Y') }}<br>
                            {{ $workshop->start_at->format('H:i') }} WIB
                        </td>
                        <td style="font-weight: 600; color: var(--color-primary);">
                            Rp {{ number_format($workshop->price, 0, ',', '.') }}
                        </td>
                        <td>
                            <span>{{ $workshop->registered_count }}</span>
                            <span style="color: var(--color-gray-400);">/{{ $workshop->quota }}</span>
                        </td>
                        <td>
                            @if($workshop->is_active)
                                <span class="badge badge-green">Aktif</span>
                            @else
                                <span class="badge badge-gray">Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            <div style="display: flex; gap: 6px;">
                                <a href="{{ route('admin.workshops.show', $workshop) }}" class="btn btn-outline btn-sm">Peserta</a>
                                <a href="{{ route('admin.workshops.edit', $workshop) }}" class="btn btn-outline btn-sm">Edit</a>
                                <form method="POST" action="{{ route('admin.workshops.destroy', $workshop) }}" onsubmit="return confirm('Hapus workshop ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; color: var(--color-gray-400); padding: 40px;">Belum ada workshop.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{ $workshops->links('components.pagination') }}
@endsection
