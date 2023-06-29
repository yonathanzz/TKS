@extends('layout.conquer')
@section('title', 'Detail Nota Jual')

@section('konten')
<div>
    <h2>Detail Nota Penjualan</h2>
    <a href="{{url('penjualan')}}" class="close"></a>
</div>



    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Harga Jual</th>
                <th>Sub Total</th>
                <th>Barcode</th>
                <th>Update</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($nota->barangs as $b)
                <tr>
                    <td>{{ $b->id }}</td>
                    <td>{{ $b->nama }}</td>
                    <td>{{ $b->pivot->jumlah }} Pcs</td>
                    <td>Rp. {{ $b->harga_jual }}</td>
                    <td>Rp. {{ $b->pivot->harga }}</td>
                    <td>{{ $b->barcode }}</td>
                    <td><a class='btn btn-xs btn-warning' data-toggle='modal' href='#modalEdit'
                            onclick='getEditForm({{ $b->id }})'>+ Edit</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
