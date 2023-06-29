@extends('layout.conquer')

@section('title', 'Nota Beli Page')

@section('konten')
    <h2>Nota Pembelian</h2>
    <p>List Pembelian</p>
    @if(session('status'))
        <div class="alert alert-success">{{session('status')}}</div>
    @endif

    <a data-target="#modalcreate" data-toggle="modal" class="btn btn-info">+ Pembelian Baru</a>
    <div class="modal fade" id="modalcreate" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Add New Buying</h4>
                </div>
                <form role="form" method="POST" action="{{ route('pembelian.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-body">
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="datetime-local" class="form-control" id="tanggal" name="tanggal">
                            </div>
                            <div class="form-group">
                                <label>Nama Supplier</label>
                                <select name="supplier_id" id="supplier_id">
                                    @foreach ($suppliers as $s)
                                    <option value="{{$s->id}}">{{$s->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Total Bayar</label>
                                <input type="text" class="form-control" id="total_bayar" name="total_bayar">
                            </div>                           
                            <div class="form-group">
                                <label>Tanggal Jatuh Tempo</label>
                                <input type="datetime-local" class="form-control" id="tanggal_jatuh_tempo" name="tanggal_jatuh_tempo">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ url('pembelian') }}" class="btn btn-default" data-dismiss="modal">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tanggal</th>
                <th>Nama Supplier</th>
                <th>Total Bayar</th>
                <th>Status</th>
                <th>Tanggal Pembayaran</th>
                <th>Tanggal Jatuh Tempo</th>
                <th>Update</th>
                <th>Detail Nota</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($notabelis as $n)
                <tr>
                    <td>{{ $n->id }}</td>
                    <td>{{ $n->tanggal }}</td>
                    <td>{{ $n->supplier->nama }}</td>
                    <td>{{ $n->total_bayar }}</td>
                    <td>{{ $n->status }}</td>
                    <td>{{ $n->tanggal_pembayaran }}</td>
                    <td>{{ $n->tanggal_jatuh_tempo }}</td>
                    <td><a class='btn btn-xs btn-warning' href="{{route('pembelian.edit', $n->id)}}">+ Edit</a></td>
                    <td><a href="{{route('detailNotaBeli.productsFromNota', $n->id)}}" class="btn btn-xs btn-success">Detail</a></td>
                    <td>
                        <form method="POST" action="{{ route('pembelian.destroy', $n->id) }}">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Hapus" class="btn btn-danger"
                                onclick="return confirm('Apakah anda yakin menghapus data ini? ({{ $n->id }})')">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
