@extends('layout.conquer')

@section('title', 'Pencarian Produk Page')

@section('konten')

<h1>Search Results for "{{ $query }}"</h1>

<a href="{{ url('barang') }}" class="btn btn-default" data-dismiss="modal">Back</a>

@if ($barangs->isEmpty())
    <p>No results found.</p>
@else
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Barang</th>
                <th>Stok</th>
                <th>Harga Jual</th>
                <th>HPP</th>
                <th>Barcode</th>
                <th>Update</th>
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
                    <td>
                        <a class='btn btn-xs btn-warning' href="{{ route('barang.edit', $b->id) }}">+ Edit</a>
                    <td>
                        <form method="POST" action="{{ route('barang.destroy', $b->id) }}">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Hapus" class="btn btn-danger"
                                onclick="return confirm('Apakah anda yakin menghapus data ini? ({{ $b->nama }})')">
                    </td>

                    </form>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
@endif

@endsection
