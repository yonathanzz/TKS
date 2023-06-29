@extends('layout.conquer')

@section('title', 'List Retur Page')

@section('konten')

    <h2>Retur</h2>
    <p>List Retur</p>

    <a data-target="#modalcreate" data-toggle="modal" class="btn btn-info">+ Retur Baru</a>

    <div class="modal fade" id="modalcreate" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Add New Barang</h4>
                </div>
                <form role="form" method="POST" action="{{ route('retur.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-body">
                            <div class="form-group">
                                <label>Tanggal Retur</label>
                                <input type="datetime-local" class="form-control" id="tanggal_retur" name="tanggal_retur">
                            </div>
                            <div class="form-group">
                                <label>Jumlah</label>
                                <input type="number" class="form-control" id="jumlah" name="jumlah">
                            </div>
                            <div class="form-group">
                                <label>ID Barang</label>
                                <select name="idBarang" id="idBarang">
                                    @foreach ($barangs as $b)
                                    <option value="{{$b->id}}">{{$b->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>ID Nota Beli</label>
                                <select name="idNotaBeli" id="idNotaBeli">
                                    @foreach ($notabelis as $n)
                                    <option value="{{$n->id}}">{{$n->id}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ url('retur') }}" class="btn btn-default" data-dismiss="modal">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <br>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tanggal Retur</th>
                <th>Jumlah</th>
                <th>Nama Barang</th>
                <th>ID Nota</th>
                <th>Update</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($returs as $r)
                <tr>
                    <td>{{ $r->id }}</td>
                    <td>{{ $r->tanggal_retur }}</td>
                    <td>{{ $r->jumlah }} Pcs</td>
                    <td>{{ $r->barang->nama }}</td>
                    <td>{{ $r->nota_beli_id }}</td>
                    <td><a class='btn btn-xs btn-warning' data-toggle='modal' href='#modalEdit'
                            onclick='getEditForm({{ $r->id }})'>+ Edit</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection

@section('javascript')

@endsection
