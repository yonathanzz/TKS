@extends('layout.conquer')

@section('title', 'Tambah Pembelian')

@section('konten')

@if($errors->has('error'))
    <div class="alert alert-danger">
        {{ $errors->first('error') }}
    </div>
@endif

    <h2>Tambah Pembelian Baru</h2>
    <p></p>

    <form role="form" method="POST" action="{{ route('pembelian.store') }}">
        @csrf
        <div>
            <label>Nama Supplier</label><br>
            <select name="supplier_id" id="supplier_id">
                @foreach ($suppliers as $s)
                    <option value="{{ $s->id }}">{{ $s->nama }}</option>
                @endforeach
            </select>
        </div>
        <br>
        <div>
            <label>Tanggal Jatuh Tempo</label>
            <input type="datetime-local" class="form-control" id="tanggal_jatuh_tempo" name="tanggal_jatuh_tempo">
        </div>
        <br>

        <input type="text" id="searchBar" placeholder="Search products...">

        <table class="table" id="productTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Barang</th>
                    <th>Stok</th>
                    <th>Harga Jual</th>
                    <th>HPP</th>
                    <th>Barcode</th>
                    <th>Jumlah</th>
                    <th>Harga per Satuan</th>
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
                            <input type="number" name="produk[{{ $b->id }}][jumlah]" value="0" min="0">
                        </td>
                        <td>
                            <input type="number" name="produk[{{ $b->id }}][harga_per_satuan]"
                                value="0" min="0">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#searchBar").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#productTable tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
    </script>

@endsection
