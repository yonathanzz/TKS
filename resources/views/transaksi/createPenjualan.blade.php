@extends('layout.conquer')

@section('title', 'Nota Jual Page')

@section('konten')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <h2>Tambah Penjualan Baru</h2>
    <p></p>
    <form role="form" method="POST" action="{{ route('penjualan.store') }}">
        @csrf
        <div>
            <label>Nama Kasir</label>
            <select name="user" id="user">
                @foreach ($users as $u)
                    <option value="{{ $u->id }}">{{ $u->name }}</option>
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
                    <option value="{{ $b->id }}" data-harga="{{ $b->harga_jual }}">{{ $b->nama }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label>Jumlah</label>
            <input type="number" id="jumlah" value="0" min="0">
        </div>
        <button type="button" id="add-item" class="btn btn-success">Add Item to List</button>

        <div id="selected-items">
            <h2>Selected Items</h2>
            <table id="item-table" class="table">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Selected items will be added here -->
                </tbody>
            </table>
        </div>
        <button type="submit" class="btn btn-primary" id="submit-button">Submit</button>
        <input type="hidden" name="produk" id="hidden-produk">
        <input type="hidden" name="totalBayar" id="hidden-totalBayar">
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const addButton = document.getElementById("add-item");
            const itemList = document.getElementById("item-table").getElementsByTagName('tbody')[0];
            const submitButton = document.getElementById("submit-button");

            addButton.addEventListener("click", function() {
                const selectedBarang = document.getElementById("selected_barang");
                const jumlahInput = document.getElementById("jumlah");
                const selectedBarangName = selectedBarang.options[selectedBarang.selectedIndex].text;
                const jumlahValue = jumlahInput.value;
                const selectedHarga = selectedBarang.options[selectedBarang.selectedIndex].getAttribute(
                    "data-harga");

                if (selectedBarangName && jumlahValue > 0) {
                    const row = itemList.insertRow(0);
                    const cell1 = row.insertCell(0);
                    const cell2 = row.insertCell(1);
                    const cell3 = row.insertCell(2);
                    const cell4 = row.insertCell(3);

                    cell1.innerHTML = selectedBarangName;
                    cell2.innerHTML = jumlahValue;
                    cell3.innerHTML = selectedHarga;
                    const subtotal = parseInt(jumlahValue) * parseFloat(selectedHarga);
                    cell4.innerHTML = subtotal;


                    selectedBarang.selectedIndex = 0;
                    jumlahInput.value = "0";
                } else {
                    alert("Please select a product, specify a quantity, and choose a price.");
                }
            });

            submitButton.addEventListener("click", function() {
                const rows = itemList.rows;
                const produk = {};
                let totalBayar = 0;

                for (let i = 0; i < rows.length; i++) { // Start from i = 1 to skip the header row
                    const cells = rows[i].cells;
                    const productName = cells[0].textContent;
                    const quantity = cells[1].textContent;
                    const price = cells[2].textContent;
                    const subtotal = cells[3].textContent;

                    produk[i] = {
                        nama: productName,
                        jumlah: quantity,
                        harga: price,
                        subtotal: subtotal,
                    };

                    totalBayar += parseInt(subtotal);

                }

                const hiddenProduk = document.getElementById("hidden-produk");
                const hiddenTotalBayar = document.getElementById("hidden-totalBayar");

                hiddenProduk.value = JSON.stringify(produk);
                hiddenTotalBayar.value = totalBayar;
            });
        });
    </script>
@endsection
