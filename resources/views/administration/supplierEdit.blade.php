@extends('layout.conquer')
@section('title', 'Edit Supplier Page')

@section('konten')
<form role="form" method="POST" action="{{route('supplier.update',$suppliers->id)}}">
    <div class="modal-header">
        {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button> --}}
        <a href="{{url('supplier')}}" class="close"></a>
        <h4 class="modal-title">Edit Supplier</h4>
    </div>
    <div class="modal-body">
        @csrf
        @method('PUT')
        <div class="form-body">
            <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" id="nama" name="nama"
                    value="{{$suppliers->nama}}">
                    <label>No Telpon</label>
                <input type="text" class="form-control" id="no_telp" name="no_telp"
                    value="{{$suppliers->no_telp}}">
                    <label>Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat"
                    value="{{$suppliers->alamat}}">
                    <label>Nama Sales</label>
                <input type="text" class="form-control" id="nama_sales" name="nama_sales"
                    value="{{$suppliers->nama_sales}}">
                    <label>No Rekening</label>
                <input type="text" class="form-control" id="no_rekening" name="no_rekening"
                    value="{{$suppliers->no_rekening}}">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>
@endsection

