@extends('layout.conquer')
@section('title', 'Edit Retur Page')

@section('konten')
    <form role="form" method="POST" action="{{ route('retur.update', $returs->id) }}">
        <div class="modal-header">
            {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button> --}}
            <a href="{{url('retur')}}" class="close"></a>
            <h4 class="modal-title">Edit Nota Beli</h4>
        </div>
        <div class="modal-body">
            @csrf
            @method('PUT')
            <div class="form-body">
                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" class="form-control" id="tanggal_retur" name="tanggal_retur"
                        value="{{$notabelis->tanggal}}">
                    <label>Jumlah</label>
                    <input type="text" class="form-control" id="jumlah" name="jumlah">
                    <label for="idbarang">Id Barang</label>
                    <br>
                    <select name="idbarang" id="idbarang">
                        @foreach ($barangs as $b)
                        <option value="{{$b->id}}" @if ({{$b->id}} == {{$idbarang}})selected @endif>> {{$b->nama}} </option>
                        @endforeach
                    </select>
                    <br>
                    <select name="idNotaBeli" id="idNotaBeli">
                        @foreach ($notabelis as $n)
                        <option value="{{$n->id}}" @if ({{$n->id}} == {{$nota_beli_id}})selected @endif>> {{$s->nama}} </option>
                        @endforeach
                    </select>
                    
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
@endsection
