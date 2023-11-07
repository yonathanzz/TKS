@extends('layout.conquer')

@section('title', 'Tambah Pembelian')

@section('konten')

    @if ($errors->has('error'))
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

        <div>
            <label>Pilih Barang</label>
            <select name="selected_barang" id="selected_barang">
                <option value="" selected disabled>Pilih Barang</option>
                @foreach ($barangs as $b)
                    <option value="{{ $b->id }}">{{ $b->nama }}</option>
                @endforeach
            </select>
            <input type="number" id="jumlah" placeholder="Jumlah" value="0" min="0">
            <button type="button" id="add-item" class="btn btn-success">Add Item to List</button>
        </div>
        <br>

        <div id="selected-items">
            <h2>Selected Items</h2>
            <table id="selected-item-table" class="table">
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Selected items will be added here -->
                </tbody>
            </table>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    {{-- <form role="form" method="POST" action="{{ route('pembelian.store') }}">
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
                </tr>
            </thead>
            <tbody>
                @foreach ($barangs as $b)
                    <tr>
                        <td>{{ $b->id }}</td>
                        <td>{{ $b->nama }}</td>
                        <td>
                            <input type="number" name="produk[{{ $b->id }}][jumlah]" value="0" min="0">
                        </td>
                        <td>
                            <input type="number" name="produk[{{ $b->id }}][harga_per_satuan]" value="0"
                                min="0">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div id="selected-items">
            <h2>Selected Items</h2>
            <table id="selected-item-table" class="table">
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Harga per Satuan</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Selected items will be added here -->
                </tbody>
            </table>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form> --}}


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // $(document).ready(function() {
        //     $("#searchBar").on("keyup", function() {
        //         var value = $(this).val().toLowerCase();
        //         $("#productTable tbody tr").filter(function() {
        //             $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        //         });
        //     });
        // });
        document.addEventListener("DOMContentLoaded", function() {
            const addButton = document.getElementById("add-item");
            const itemList = document.getElementById("selected-item-table").getElementsByTagName('tbody')[0];

            addButton.addEventListener("click", function() {
                const selectedBarang = document.getElementById("selected_barang");
                const jumlahInput = document.getElementById("jumlah");
                const selectedBarangName = selectedBarang.options[selectedBarang.selectedIndex].text;
                const jumlahValue = jumlahInput.value;

                if (selectedBarangName && jumlahValue > 0) {
                    const row = itemList.insertRow(0);
                    const cell1 = row.insertCell(0);
                    const cell2 = row.insertCell(1);
                    cell1.innerHTML = selectedBarangName;
                    cell2.innerHTML = jumlahValue;

                    selectedBarang.selectedIndex = 0;
                    jumlahInput.value = "0";
                } else {
                    alert("Please select a product and specify a quantity.");
                }
            });
        });
    </script>

@endsection
