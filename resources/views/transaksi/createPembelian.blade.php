@extends('layout.conquer')

@section('title', 'Tambah Pembelian')

@section('konten')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

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
            <input type="number" id="jumlah" placeholder="Jumlah" value="" min="0">
            <input type="number" id="harga_beli" placeholder="Harga Beli" value="" min="0">
        </div>
        <button type="button" id="add-item" class="btn btn-success">Add Item to List</button>

        <div id="selected-items">
            <h2>Selected Items</h2>
            <table id="selected-item-table" class="table">
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Harga Beli</th>
                        <th>Subtotal</th> <!-- Add Subtotal column -->
                    </tr>
                </thead>
                <tbody>
                    <!-- Selected items will be added here -->
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3">Grand Total</th>
                        <td id="grand-total">0.00</td> <!-- Grand Total cell -->
                    </tr>
                </tfoot>
            </table>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        <input type="hidden" name="produk" id="hidden-purchased-items">
        <input type="hidden" name="totalBayar" id="hidden-totalBayar">
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const addButton = document.getElementById("add-item");
            const itemList = document.getElementById("selected-item-table").getElementsByTagName('tbody')[0];
            const grandTotalCell = document.getElementById("grand-total");
            const submitButton = document.querySelector("form[method='POST'] button[type='submit']");

            addButton.addEventListener("click", function() {
                const selectedBarang = document.getElementById("selected_barang");
                const jumlahInput = document.getElementById("jumlah");
                const hargaBeliInput = document.getElementById("harga_beli");
                const selectedBarangName = selectedBarang.options[selectedBarang.selectedIndex].text;
                const jumlahValue = jumlahInput.value;
                const hargaBeliValue = hargaBeliInput.value;

                if (selectedBarangName && jumlahValue > 0 && hargaBeliValue > 0) {
                    const row = itemList.insertRow(0);
                    const cell1 = row.insertCell(0);
                    const cell2 = row.insertCell(1);
                    const cell3 = row.insertCell(2);
                    const cell4 = row.insertCell(3);

                    cell1.innerHTML = selectedBarangName;
                    cell2.innerHTML = jumlahValue;
                    cell3.innerHTML = hargaBeliValue;

                    const subtotal = parseInt(jumlahValue) * parseFloat(hargaBeliValue);
                    cell4.innerHTML = subtotal;

                    updateGrandTotal();

                    selectedBarang.selectedIndex = 0;
                    jumlahInput.value = "0";
                    hargaBeliInput.value = "0";
                } else {
                    alert("Please select a product, specify a quantity, and enter the purchase price.");
                }
            });

            function updateGrandTotal() {
                const rows = itemList.rows;
                let total = 0;

                for (let i = 0; i < rows.length; i++) {
                    const cells = rows[i].cells;
                    const subtotal = parseFloat(cells[3].textContent);
                    total += subtotal;
                }

                grandTotalCell.textContent = total.toFixed(2);
            }

            submitButton.addEventListener("click", function() {
                const rows = itemList.rows;
                const purchasedItems = {};
                let totalBayar = 0;

                for (let i = 0; i < rows.length; i++) {
                    const cells = rows[i].cells;
                    const productName = cells[0].textContent;
                    const quantity = cells[1].textContent;
                    const hargaBeli = cells[2].textContent;
                    const subtotal = cells[3].textContent;

                    purchasedItems[i]={
                        nama: productName,
                        jumlah: quantity,
                        harga_beli: hargaBeli
                    };
                    totalBayar += parseInt(subtotal);
                }

                const hiddenPurchasedItems = document.getElementById("hidden-purchased-items");
                const hiddenTotalBayar = document.getElementById("hidden-totalBayar");
                hiddenPurchasedItems.value = JSON.stringify(purchasedItems);
                hiddenTotalBayar.value = totalBayar;
            });
        });
    </script>

@endsection
