@extends('layout.conquer')
@section('title', 'Edit Barang Page')

@section('konten')
    <form role="form" method="POST" action="{{ route('barang.update', $barang->id) }}">
        <div class="modal-header">
            {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button> --}}
            <a href="{{url('pembelian')}}" class="close"></a>
            <h4 class="modal-title">Edit Barang</h4>
        </div>
        <div class="modal-body">
            @csrf
            @method('PUT')
            <div class="form-body">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{$barang->nama}}">
                </div>
                <div class="form-group">
                    <label>Stok</label>
                    <input type="text" class="form-control" id="stok" name="stok" value="{{$barang->stok}}">
                </div>
                <div class="form-group">
                    <label>Harga Jual</label>
                    <input type="text" class="form-control" id="harga_jual" name="harga_jual" value="{{$barang->harga_jual}}">
                </div>
                <div class="form-group">
                    <label>HPP</label>
                    <input type="text" class="form-control" id="hpp" name="hpp" value="{{$barang->hpp}}">
                </div>
                <div class="form-group">
                    <label>Barcode</label>
                    <input type="text" class="form-control" id="barcode" name="barcode" value="{{$barang->barcode}}">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
@endsection
