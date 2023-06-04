@extends('layout.conquer')
@section('title', 'Edit Barang Page')

@section('konten')
    <form role="form" method="POST" action="{{ route('metode_pembayaran.update', $pembayaran->id) }}">
        <div class="modal-header">
            {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button> --}}
            <a href="{{url('pembelian')}}" class="close"></a>
            <h4 class="modal-title">Edit Metode Pembayaran</h4>
        </div>
        <div class="modal-body">
            @csrf
            @method('PUT')
            <div class="form-body">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{$pembayaran->nama}}">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
@endsection
