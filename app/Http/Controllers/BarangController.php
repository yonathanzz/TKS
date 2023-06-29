<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $barangs = Barang::all();
        return view('inventory.barang', compact('barangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = new Barang();
        $data->nama = $request->get('nama');
        $data->stok = $request->get('stok');
        $data->harga_jual = $request->get('harga_jual');
        $data->hpp = $request->get('hpp');
        $data->barcode = $request->get('barcode');
        $data->save();

        return redirect()->route('barang.index')->with('success', 'Data has been successfully added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $barang = Barang::find($id);
        return view('inventory.barangEdit', compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $obj = Barang::find($id);
        $obj->nama = $request->get('nama');
        $obj->stok = $request->get('stok');
        $obj->harga_jual = $request->get('harga_jual');
        $obj->hpp = $request->get('hpp');
        $obj->barcode = $request->get('barcode');
        $obj->save();

        return redirect()->route('barang.index')->with('status', 'Your data is already up-to-date');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $obj = Barang::find($id);
            $obj->delete();
            return redirect()->route('barang.index')->with('status', 'Data berhasil di hapus');
        } catch (\PDOException $ex) {
            $msg = "Data Gagal dihapus";
            return redirect()->route('barang.index')->with('status', $msg);
        }
    }

    public function getEditForm(Request $request)
    {
        $id = $request->get('id');
        $data = Barang::find($id);
        return response()->json([
            'status' => 'oke',
            'msg' => view('inventory.getEditForm', compact('data'))->render()
        ], 200);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $barangs = Barang::where('nama', 'LIKE', '%' . $query . '%')
            ->get();

        return view('inventory.search', compact('barangs', 'query'));
    }
}
