@extends('layout.conquer')

@section('title', 'Nota Jual Page')

@section('konten')
    <h2>Tambah Penjualan Baru</h2>
    <p></p>
    <form role="form" method="POST" action="{{ route('penjualan.store') }}">
        @csrf
        <div>
            <label>Nama Kasir</label>
            <select name="user" id="user">
                @foreach ($users as $u)
                    <option value="{{ $u->id }}">{{ $u->nama }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label>Metode Pembayaran</label>
            <select name="metpem" id="metpem">
                @foreach ($metode_pembayarans as $m)
                    <option value="{{ $m->id }}">{{ $m->nama }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label>Pilih Barang</label>
            <select name="selected_barang" id="selected_barang">
                <option value="" selected disabled>Pilih Barang</option>
                @foreach ($barangs as $b)
                    <option value="{{ $b->id }}">{{ $b->nama }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label>Jumlah</label>
            <input type="number" name="jumlah" id="jumlah" value="0" min="0">
        </div>
        <button type="button" id="add-item" class="btn btn-success">Add Item to List</button>
    </form>
    
    <div id="selected-items">
        <h2>Selected Items</h2>
        <table id="item-table" class="table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                <!-- Selected items will be added here -->
            </tbody>
        </table>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const addButton = document.getElementById("add-item");
            const itemList = document.getElementById("item-table").getElementsByTagName('tbody')[0];
    
            addButton.addEventListener("click", function () {
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
    

    {{-- <form role="form" method="POST" action="{{ route('penjualan.store') }}">
        @csrf
        <div>
            <label>Nama Kasir</label>
            <select name="user" id="user">
                @foreach ($users as $u)
                    <option value="{{$u->id}}">{{$u->nama}}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label>Metode Pembayaran</label>
            <select name="metpem" id="metpem">
                @foreach ($metode_pembayarans as $m)
                    <option value="{{$m->id}}">{{$m->nama}}</option>
                @endforeach
            </select>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Barang</th>
                    <th>Stok</th>
                    <th>Harga Jual</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barangs as $b)
                    <tr>
                        <td>{{ $b->id }}</td>
                        <td>{{ $b->nama }}</td>
                        <td>{{ $b->stok }} Pcs</td>
                        <td>Rp. {{ $b->harga_jual }}</td>
                        <td>
                            <input type="number" name="produk[{{ $b->id }}][jumlah]" value="0" min="0">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form> --}}
@endsection
