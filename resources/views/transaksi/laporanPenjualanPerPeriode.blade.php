<!-- transactions_by_date.blade.php -->

@extends('layout.conquer')

@section('title', 'Transactions by Date')

@section('konten')
<h1 style="text-align: center; text-decoration: underline">Toko Karya Sejahtera</h1>
    <h2 style="text-align: center">Laporan Penjualan per Periode</h2>
    <p style="text-align: center">Transaksi pada periode tanggal {{ $startDate }} hingga {{ $endDate }}</p>
<br>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tanggal</th>
                <th>Total Bayar</th>
                <th>Nama Kasir</th>
                <th>Metode Pembayaran</th>
                <th>Detail Nota</th>
                <th>HPP</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penjualansWithProfit as $n)
                <tr>
                    <td>{{ $n->id }}</td>
                    <td>{{ $n->tanggal_waktu }}</td>
                    <td>{{ $n->total_bayar }}</td>
                    <td>{{ $n->user->name }}</td>
                    <td>{{ $n->metode_pembayaran->nama }}</td>
                    <td><a href="{{ route('detailNotaJual.productsFromNota', $n->id) }}"
                            class="btn btn-xs btn-success">Detail</a></td>
                    <td>Rp. {{ number_format($n->barangs->sum('pivot.hpp'), 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Summary Section -->
    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title">Kesimpulan</h4>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Total Transaksi: {{ count($penjualansWithProfit) }} Nota Penjualan</li>
                <li class="list-group-item">Total Penjualan: Rp. {{ number_format($penjualansWithProfit->sum('total_bayar'), 0, ',', '.') }}</li>
                <li class="list-group-item">Total Profit: Rp. {{ number_format($penjualansWithProfit->sum('profit'), 0, ',', '.') }}</li>
            </ul>
        </div>
    </div>


    <a class="btn btn-primary" href="{{ route('penjualan.index') }}">Back to All Transactions</a>
@endsection
