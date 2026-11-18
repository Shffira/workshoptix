
@extends('layouts.admin')

@section('title', 'Pembayaran')
@section('page-title', 'Data Pembayaran')

@section('content')

<div class="card">
    <div class="card-header">
        <h2>Riwayat Pembayaran</h2>
        <span>{{ $payments->total() }} Transaksi</span>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Peserta</th>
                    <th>Workshop</th>
                    <th>Order ID</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>

            <tbody>
                @forelse($payments as $payment)
                    <tr>
                        <td>{{ $payment->user->name }}</td>
                        <td>{{ $payment->workshop->title }}</td>
                        <td>{{ $payment->payment_id ?? '-' }}</td>
                        <td>
                            Rp {{ number_format($payment->amount, 0, ',', '.') }}
                        </td>
                        <td>
                            @if($payment->status === 'paid')
                                <span class="badge badge-green">Lunas</span>
                            @elseif($payment->status === 'pending')
                                <span class="badge badge-yellow">Pending</span>
                            @else
                                <span class="badge badge-red">Batal</span>
                            @endif
                        </td>
                        <td>{{ $payment->created_at->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align:center; padding:30px;">
                            Belum ada transaksi.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{ $payments->links('components.pagination') }}

@endsection
