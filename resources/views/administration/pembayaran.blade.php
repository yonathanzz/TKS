@extends('layout.conquer')

@section('title', 'List Metode Pembayaran')

@section('konten')
    <h2>Metode Pembayaran</h2>
    <p>List Metode Pembayaran</p>


    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Metode</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pembayarans as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->nama }}</td>
                    <td><a class='btn btn-xs btn-warning' data-toggle='modal' href='#modalEdit'
                            onclick='getEditForm({{ $p->id }})'>+ Edit</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
