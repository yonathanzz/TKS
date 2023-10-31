@extends('layout.conquer')

@section('title', 'Nota Jual Page')

@section('konten')
    <h2>Tambah Penjualan Baru</h2>
    <p></p>

    <form role="form" method="POST" action="{{ route('penjualan.store') }}">
        @csrf
        <div>
            <label>Nama Kasir</label>
            <select name="user" id="user">
                @foreach ($users as $u)
                    <option value="{{$u->id}}">{{$u->nama}}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label>Metode Pembayaran</label>
            <select name="metpem" id="metpem">
                @foreach ($metode_pembayarans as $m)
                    <option value="{{$m->id}}">{{$m->nama}}</option>
                @endforeach
            </select>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Barang</th>
                    <th>Stok</th>
                    <th>Harga Jual</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barangs as $b)
                    <tr>
                        <td>{{ $b->id }}</td>
                        <td>{{ $b->nama }}</td>
                        <td>{{ $b->stok }} Pcs</td>
                        <td>Rp. {{ $b->harga_jual }}</td>
                        <td>
                            <input type="number" name="produk[{{ $b->id }}][jumlah]" value="0" min="0">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
