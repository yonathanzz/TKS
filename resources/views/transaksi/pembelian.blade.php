@extends('layout.conquer')

@section('title', 'Nota Beli Page')

@section('konten')
    <h2>Nota Pembelian</h2>
    <p>List Pembelian</p>

    {{-- <a data-target="#modalcreate" data-toggle="modal" class="btn btn-info">+ Supplier Baru</a>
    <div class="modal fade" id="modalcreate" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Add New Supplier</h4>
                </div>
                <form role="form" method="POST" action="{{ route('supplier.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-body">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama">
                            </div>
                            <div class="form-group">
                                <label>No Telp</label>
                                <input type="text" class="form-control" id="no_telp" name="no_telp">
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat">
                            </div>
                            <div class="form-group">
                                <label>Nama Sales</label>
                                <input type="text" class="form-control" id="nama_sales" name="nama_sales">
                            </div>
                            <div class="form-group">
                                <label>No Rekening</label>
                                <input type="text" class="form-control" id="no_rekening" name="no_rekening">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ url('supplier') }}" class="btn btn-default" data-dismiss="modal">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}

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
                    <td><a class='btn btn-xs btn-warning' data-toggle='modal' href='#modalEdit'
                            onclick='getEditForm({{ $n->id }})'>+ Edit</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
