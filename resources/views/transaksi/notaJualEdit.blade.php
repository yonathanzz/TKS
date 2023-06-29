@extends('layout.conquer')
@section('title', 'Edit Nota Beli Page')

@section('konten')
    <form role="form" method="POST" action="{{ route('penjualan.update', $notajual->id) }}">
        <div class="modal-header">
            {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button> --}}
            <a href="{{url('penjualan')}}" class="close"></a>
            <h4 class="modal-title">Edit Nota Jual</h4>
        </div>
        <div class="modal-body">
            @csrf
            @method('PUT')
            <div class="form-body">
                <div class="form-group">
                    <label>Total Bayar</label>
                    <input type="text" class="form-control" id="total_bayar" name="total_bayar"
                        value="{{ $notajual->total_bayar }}">
                    <label>Kasir</label>
                    <br>
                    <select name="user_id" id="user_id">
                        @foreach ($users as $u)
                            <option value="{{$u->id}}" @if ($u->id == $selUser->id) selected @endif> {{$u->nama}} </option>
                        @endforeach
                    </select>
                    <br>

                    <label>Metode Pembayaran</label>
                    <br>
                    <select name="metode_pembayaran_id" id="metode_pembayaran_id">
                        @foreach ($metpems as $m)
                        <option value="{{$m->id}}" @if ($m->id == $selMetpem->id)selected @endif> {{$m->nama}} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
@endsection
