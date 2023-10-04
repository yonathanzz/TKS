<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\DetailNotaBeli;
use App\Models\NotaBeli;
use App\Models\Supplier;
use Illuminate\Http\Request;

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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = new NotaBeli();
        $data->tanggal = date('Y-m-d H:i:s', strtotime($request->get('tanggal')));
        $data->supplier_id = $request->get('supplier_id');
        $data->total_bayar = $request->get('quantity') * $request->get('harga_satuan');
        $data->status = 'diproses';
        // $data->tanggal_pembayaran = date('Y-m-d H:i:s');
        $data->tanggal_jatuh_tempo = date('Y-m-d H:i:s', strtotime($request->get('tanggal_jatuh_tempo')));
        $data->save();

        // $tambahBarang = Barang::find($request->get('id'));
        // $tambahBarang->stok += $request->get('quantity');
        // $tambahBarang->hpp = (($tambahBarang->stok * $tambahBarang->hpp) + ($request->get('quantity') * $request->get('harga_satuan')))/($tambahBarang->stok + $request->get('quantity'));
        $detailNota = new DetailNotaBeli();
        $detailNota->barang_id = $request->input('idbarang'); // Ensure that 'idbarang' matches the name attribute in your form
        $detailNota->nota_beli_id = $data->id;
        $detailNota->jumlah = $request->get('quantity');
        $detailNota->harga_beli = $request->get('harga_satuan');
        $detailNota->status = 'diproses';
        $detailNota->save();


        $tambahBarang = Barang::find($request->get('idbarang'));
        $tambahBarang->stok += $request->get('quantity');
        $totalCostCurrentStock = $tambahBarang->stok * $tambahBarang->hpp;
        $newPurchaseCost = $request->get('quantity') * $request->get('harga_satuan');
        $newHPP = ($totalCostCurrentStock + $newPurchaseCost) / ($tambahBarang->stok);
        $tambahBarang->hpp = $newHPP;

        $tambahBarang->save();

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
