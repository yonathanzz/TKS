@extends('layout.conquer')

@section('title', 'Tambah Pembelian')

@section('konten')

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
                                <label>Jumlah Barang</label>
                                <input type="text" class="form-control" id="total_bayar" name="total_bayar">
                            </div>
                            <div class="form-group">
                                <label>Harga</label>
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

    <form action="{{ route('barang.search') }}" method="GET">
        <input type="text" name="query" placeholder="Search products...">
        <button type="submit">Search</button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Barang</th>
                <th>Stok</th>
                <th>Harga Jual</th>
                <th>HPP</th>
                <th>Barcode</th>
                <th>Beli</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangs as $b)
                <tr>
                    <td>{{ $b->id }}</td>
                    <td>{{ $b->nama }}</td>
                    <td>{{ $b->stok }} Pcs</td>
                    <td>Rp. {{ $b->harga_jual }}</td>
                    <td>Rp. {{ $b->hpp }}</td>
                    <td>{{ $b->barcode }}</td>
                    <td><a data-target="#modalcreate" data-toggle="modal" class="btn btn-info">+ Pembelian Barang</a></td>

                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- <div class="modal fade" id="modalEdit" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="modalContent">
            @include('inventory.getEditForm')
        </div>
    </div>
</div> --}}

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
