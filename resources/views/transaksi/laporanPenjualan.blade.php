@extends('layout.conquer')

@section('title', 'Nota Jual Page')

@section('konten')
    <h2>Laporan Penjualan</h2>
    <p>List Penjualan</p>
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <a class='btn btn-info' href="{{ route('penjualan.create') }}">+ Penjualan</a>
    <br>
    <br>

    <form method="GET" action="{{ route('transactions.by.date') }}">
        @csrf

        <label>Tanggal Awal</label><input type="month" class="form-control" name="start_date" required>
        <label>Tanggal Akhir</label><input type="month" class="form-control" name="end_date" required>
        <button type="submit" class="btn btn-primary">Cek Laporan Penjualan per Periode</button>
    </form>

    <br>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tanggal</th>
                <th>Total Bayar</th>
                <th>Nama Kasir</th>
                <th>Metode Pembayaran</th>
                <th>Update</th>
                <th>Detail Nota</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penjualans as $n)
                <tr>
                    <td>{{ $n->id }}</td>
                    <td>{{ $n->tanggal_waktu }}</td>
                    <td>{{ $n->total_bayar }}</td>
                    <td>{{ $n->user->name }}</td>
                    <td>{{ $n->metode_pembayaran->nama }}</td>
                    <td><a class='btn btn-xs btn-warning' href="{{ route('penjualan.edit', $n->id) }}">+ Edit</a></td>
                    <td><a href="{{ route('detailNotaJual.productsFromNota', $n->id) }}"
                            class="btn btn-xs btn-success">Detail</a></td>
                    <td>
                        <form method="POST" action="{{ route('penjualan.destroy', $n->id) }}">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Hapus" class="btn btn-danger"
                                onclick="return confirm('Apakah anda yakin menghapus data ini? ({{ $n->id }})')">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
