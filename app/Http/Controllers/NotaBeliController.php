<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\DetailNotaBeli;
use App\Models\NotaBeli;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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
        try {
            // Create a new NotaBeli record
            $data = new NotaBeli();
            $data->tanggal = now();
            $data->supplier_id = $request->get('supplier_id');
            $data->status = 'diproses';
            $data->tanggal_jatuh_tempo = date('Y-m-d H:i:s', strtotime($request->get('tanggal_jatuh_tempo')));
            $data->total_bayar = 0; // Initialize total_bayar to 0
            $data->save();

            // Handle the products selected in the form
            $productsWithDetails = $request->input('produk', []);

            foreach ($productsWithDetails as $productId => $productInfo) {
                $quantity = $productInfo['jumlah'];
                $hargaSatuan = $productInfo['harga_per_satuan'];

                if ($quantity > 0) {

                    $barang = Barang::find($productId);

                    if ($barang) {

                        $data->barangs()->attach($productId, ['jumlah' => $quantity, 'harga_beli' => $hargaSatuan, 'status' => 'diproses']);
                        $totalCostCurrentStock = $barang->stok * $barang->hpp;
                        $newPurchaseCost = $quantity * $hargaSatuan;
                        $newHPP = ($totalCostCurrentStock + $newPurchaseCost) / ($barang->stok + $quantity);
                        $barang->hpp = $newHPP;
                        $barang->stok += $quantity;
                        $barang->save();


                        $data->total_bayar += $quantity * $hargaSatuan;
                    }
                }
            }

            $data->save();

            return redirect()->route('pembelian.index')->with('success', 'Data has been successfully added.');
        } catch (ValidationException $e) {
            // Validation exception occurred, meaning the process failed
            return redirect()->route('pembelian.create')->withErrors($e->errors());
        }
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
