@extends('layout.conquer')
@section('title', 'Detail Nota Beli')

@section('konten')
<div>
    <h2>Detail Nota Pembelian</h2>
    <a href="{{url('pembelian')}}" class="close"></a>
</div>



    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Harga Beli</th>
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
                    <td>Rp. {{ $b->pivot->harga_beli }}</td>
                    <td>Rp. {{ $b->pivot->jumlah * $b->pivot->harga_beli}}</td>
                    <td>{{ $b->barcode }}</td>
                    <td><a class='btn btn-xs btn-warning' data-toggle='modal' href='#modalEdit'
                            onclick='getEditForm({{ $b->id }})'>+ Edit</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
