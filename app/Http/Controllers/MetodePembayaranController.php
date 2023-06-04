<?php

namespace App\Http\Controllers;

use App\Models\MetodePembayaran;
use Illuminate\Http\Request;

class MetodePembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembayarans = MetodePembayaran::all();
        return view('administration.pembayaran', compact('pembayarans'));
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
    }

    /**
     * Display the specified resource.
     */
    public function show(MetodePembayaran $metodePembayaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        //
        $pembayaran = MetodePembayaran::find($id);
        return view('administration.pembayaranEdit',compact('pembayaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        //
        $obj = MetodePembayaran::find($id);
        $obj->nama = $request->get('nama');
        $obj->save();

        return redirect()->route('metode_pembayaran.index')->with('status','Your data is already up-to-date');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MetodePembayaran $metodePembayaran)
    {
        //
    }
}
