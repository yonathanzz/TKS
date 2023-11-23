<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\DetailNotaBeli;
use App\Models\NotaBeli;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class NotaBeliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $notabelis = NotaBeli::all();
        $suppliers = Supplier::all();
        return view('transaksi.pembelian', compact('notabelis', 'suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $barangs = Barang::all();
        $suppliers = Supplier::all();
        return view('transaksi.createpembelian', compact('suppliers', 'barangs'));
    }

    public function store(Request $request)
    {
        $notaBeli = new NotaBeli();
        $notaBeli->tanggal = now();
        $notaBeli->supplier_id = $request->get('supplier_id');
        $notaBeli->status = 'diproses';
        $notaBeli->tanggal_jatuh_tempo = date('Y-m-d H:i:s', strtotime($request->get('tanggal_jatuh_tempo')));


        $purchasedItems = json_decode($request->input('purchasedItems'), true);
        $totalBayar = $request->input('totalBayar');

        if ($totalBayar <= 0) {
            return redirect()->route('pembelian.create')->with('error', 'Invalid totalBayar value.');
        }
        $notaBeli->total_bayar = $totalBayar;
        $notaBeli->save();

        //ini aneh dia gamau ngeinsert ke pivot table (tabel detail_nota_belis)nya.

        if ($purchasedItems !== null) {
            foreach ($purchasedItems as $item) {
                $barang = Barang::where('nama', $item['nama'])->first();

                if ($barang) {
                    $quantity = $item['jumlah'];
                    $hargaBeli = $item['harga_beli'];
                    $subtotal = $quantity * $hargaBeli;

                    // Add record to DetailNotaBelis pivot table
                    $notaBeli->barangs()->attach($barang->id, ['jumlah' => $quantity, 'harga_beli' => $hargaBeli, 'status' => 'diproses']);


                    // Cumulative cost of current stock
                    $totalCostCurrentStock = $barang->stok * $barang->hpp; // 8 * ~50,000 = ~400,000

                    // New total cost after the purchase
                    $newTotalCost = $totalCostCurrentStock + $subtotal; // ~504,000 (400,000 + 104,000)

                    // New total stock after the purchase
                    $newTotalStock = $barang->stok + $quantity; // 8 + 2 = 10

                    // Calculate the new HPP considering the total cost and total stock
                    $newHPP = $newTotalCost / $newTotalStock; // ~504,000 / 10 = ~50,400
                    $barang->hpp = $newHPP; // Update the HPP
                    $barang->save();

                    $barang->stok = $newTotalStock;
                    $barang->save();

                    $notaBeli->total_bayar += $subtotal;
                } else {
                    return redirect()->route('penjualan.create')->with('error', 'Invalid product: ' . $item['nama']);
                }
            }
        } else {
            return redirect()->route('pembelian.create')->with('error', 'Null purchasedItems');
        }

        return redirect()->route('pembelian.index')->with('success', 'Data has been successfully added.');
    }




    /**
     * Display the specified resource.
     */
    public function show(NotaBeli $notaBeli)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $obj = NotaBeli::find($id);
        $objsupp = $obj->supplier_id;
        $suppliers = Supplier::all();
        $notabelis = $obj;
        return view('transaksi.notaBeliEdit', compact('notabelis', 'suppliers', 'objsupp'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $obj = NotaBeli::find($id);
        $obj->tanggal = $request->get('tanggal');
        $obj->supplier_id = $request->get('supplier_id');
        $obj->total_bayar = $request->get('total_bayar');
        $obj->status = $request->get('status');
        $obj->tanggal_pembayaran = $request->get('tanggal_pembayaran');
        $obj->tanggal_jatuh_tempo = $request->get('tanggal_jatuh_tempo');
        $obj->save();

        return redirect()->route('pembelian.index')->with('status', 'Your data is already up-to-date');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $obj = NotaBeli::find($id);
            $obj->delete();
            return redirect()->route('pembelian.index')->with('status', 'Data berhasil di hapus');
        } catch (\PDOException $ex) {
            $msg = "Data Gagal dihapus";
            return redirect()->route('pembelian.index')->with('status', $msg);
        }
    }
}
