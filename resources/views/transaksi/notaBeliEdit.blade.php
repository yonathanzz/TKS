@extends('layout.conquer')
@section('title', 'Edit Nota Beli Page')

@section('konten')
    <form role="form" method="POST" action="{{ route('pembelian.update', $notabelis->id) }}">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">Edit Nota Beli</h4>
        </div>
        <div class="modal-body">
            @csrf
            @method('PUT')
            <div class="form-body">
                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal"
                        value="{{$notabelis->tanggal}}">
                    <label>Supplier</label>
                    <br>
                    <select name="supplier_id" id="supplier_id">
                        @foreach ($suppliers as $s)
                        <option value="{{$s->id}}" {{--@if ({{$s->id}} == {{$objsupp->id}})selected @endif>--}}> {{$s->nama}} </option>
                        @endforeach
                    </select>
                    <br>
                    <label>Total Bayar</label>
                    <input type="text" class="form-control" id="total_bayar" name="total_bayar"
                        value="{{ $notabelis->total_bayar }}">
                    <label>Status</label>
                    <input type="text" class="form-control" id="status" name="status"
                        value="{{ $notabelis->status }}">
                    <label>Tanggal Pembayaran</label>
                    <input type="date" class="form-control" id="tanggal_pembayaran" name="tanggal_pembayaran"
                        value="{{ $notabelis->tanggal_pembayaran }}">
                    <label>Tanggal Jatuh Tempo</label>
                    <input type="date" class="form-control" id="tanggal_jatuh_tempo" name="tanggal_jatuh_tempo"
                        value="{{ $notabelis->tanggal_jatuh_tempo }}">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
@endsection
