<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return view('administration.supplier', compact('suppliers'));
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
        $data = new Supplier();
        $data->nama = $request->get('nama');
        $data->no_telp = $request->get('no_telp');
        $data->alamat = $request->get('alamat');
        $data->nama_sales = $request->get('nama_sales');
        $data->no_rekening = $request->get('no_rekening');
        $data->save();

        return redirect()->route('supplier.index')->with('success', 'Data has been successfully added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit($id)
    {
        $obj = Supplier::find($id);
        $suppliers = $obj;
        return view('administration.supplierEdit',compact('suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $obj = Supplier::find($id);
        $obj->nama = $request->get('nama');
        $obj->no_telp = $request->get('no_telp');
        $obj->alamat = $request->get('alamat');
        $obj->nama_sales = $request->get('nama_sales');
        $obj->no_rekening = $request->get('no_rekening');
        $obj->save();

        return redirect()->route('supplier.index')->with('status','Your Supplier is already up-to-date');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $obj = Supplier::find($id);
            $obj->delete();
            return redirect()->route('supplier.index')->with('status','Data berhasil di hapus');
        }
        catch(\PDOException $ex){
            $msg = "Data Gagal dihapus";
            return redirect()->route('supplier.index')->with('status',$msg);
        }
    }
}
