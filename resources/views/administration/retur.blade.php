@extends('layout.conquer')

@section('title', 'List Retur Page')

@section('konten')

    <h2>Retur</h2>
    <p>List Retur</p>

    <a data-target="#modalcreate" data-toggle="modal" class="btn btn-info">+ Retur Baru</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tanggal Retur</th>
                <th>Jumlah</th>
                <th>Nama Barang</th>
                <th>ID Nota</th>
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
