@extends('layout.conquer')
@section('title', 'Edit Nota Beli Page')

@section('konten')
    <form role="form" method="POST" action="{{ route('pembelian.update', $notabelis->id) }}">
        <div class="modal-header">
            <a href="{{ url('pembelian') }}" class="close"></a>
            <h4 class="modal-title">Edit Nota Beli</h4>
        </div>
        <div class="modal-body">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="datetime-local" class="form-control" id="tanggal" name="tanggal"
                    value="{{ $notabelis->tanggal }}">
            </div>
            <div class="form-group">
                <label for="supplier_id">Supplier</label>
                <select name="supplier_id" id="supplier_id" class="form-control">
                    @foreach ($suppliers as $s)
                        <option value="{{ $s->id }}"> {{ $s->nama }} </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="total_bayar">Total Bayar</label>
                <input type="text" class="form-control" id="total_bayar" name="total_bayar"
                    value="{{ $notabelis->total_bayar }}">
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    @if ($notabelis->status === 'diproses')
                        <option value="diproses" selected>diproses</option>
                        <option value="lunas">lunas</option>
                    @else
                        <option value="diproses">diproses</option>
                        <option value="lunas" selected>lunas</option>
                    @endif
                </select>
            </div>
            <div class="form-group">
                <label for="tanggal_pembayaran">Tanggal Pembayaran</label>
                <input type="datetime-local" class="form-control" id="tanggal_pembayaran" name="tanggal_pembayaran"
                    value="{{ $notabelis->tanggal_pembayaran }}">
            </div>
            <div class="form-group">
                <label for="tanggal_jatuh_tempo">Tanggal Jatuh Tempo</label>
                <input type="datetime-local" class="form-control" id="tanggal_jatuh_tempo" name="tanggal_jatuh_tempo"
                    value="{{ $notabelis->tanggal_jatuh_tempo }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
@endsection
