<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getEditForm(Request $request)
    {
        $id=$request->get('id');
        $data=Barang::find($id);
        return response()->json([
            'status'=>'oke',
            'msg'=>view('inventory.getEditForm', compact('data'))->render()
        ], 200);
    }
}
