@extends('layout.conquer')

@section('title', 'List Metode Pembayaran')

@section('konten')
    <h2>Metode Pembayaran</h2>
    <p>List Metode Pembayaran</p>
    @if(session('status'))
        <div class="alert alert-success">{{session('status')}}</div>
    @endif
    <a data-target="#modalcreate" data-toggle="modal" class="btn btn-info">+ Metode Baru</a>

    <div class="modal fade" id="modalcreate" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Add New Method</h4>
                </div>
                <form role="form" method="POST" action="{{ route('metode_pembayaran.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-body">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ url('metode_pembayaran') }}" class="btn btn-default" data-dismiss="modal">Cancel</a>
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
                <th>Nama Metode</th>
                <th>Update</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pembayarans as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->nama }}</td>
                    <td><a class='btn btn-xs btn-warning' href="{{route('metode_pembayaran.edit', $p->id)}}">+ Edit</a></td>
                    <td>
                        <form method="POST" action="{{ route('metode_pembayaran.destroy', $p->id) }}">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Hapus" class="btn btn-danger"
                                onclick="return confirm('Apakah anda yakin menghapus data ini? ({{ $p->nama }})')">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
