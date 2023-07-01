<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\NotaBeli;
use App\Models\Retur;
use Illuminate\Http\Request;

class ReturController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $returs = Retur::all();
        $barangs = Barang::all();
        $notabelis = NotaBeli::all();
        return view('administration.retur', compact('returs','barangs','notabelis'));
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
        $data = new Retur();
        $data->tanggal_retur = $request->get('tanggal_retur');
        $data->jumlah = $request->get('jumlah');
        $data->barang_id = $request->get('idBarang');
        $data->nota_beli_id = $request->get('idNotaBeli');
        $data->save();

        return redirect()->route('retur.index')->with('success', 'Data has been successfully added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Retur $retur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $returs = Retur::find($id);
        $idbarang = $returs->barang_id;
        $nota_beli_id = $returs->nota_beli_id;
        $barangs = Barang::all();
        $notabelis = NotaBeli::all();
        return view('administration.returEdit', compact('returs','barangs','notabelis','nota_beli_id','idbarang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Retur::find($id);
        $data->tanggal_retur = $request->get('tanggal_retur');
        $data->jumlah = $request->get('jumlah');
        $data->barang_id = $request->get('idBarang');
        $data->nota_beli_id = $request->get('idNotaBeli');
        $data->save();

        return redirect()->route('retur.index')->with('success', 'Data has been successfully added.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $obj = Retur::find($id);
            $obj->delete();
            return redirect()->route('retur.index')->with('status','Data berhasil di hapus');
        }
        catch(\PDOException $ex){
            $msg = "Data Gagal dihapus";
            return redirect()->route('retur.index')->with('status',$msg);
        }
    }
}
