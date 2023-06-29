<?php

namespace App\Http\Controllers;

use App\Models\DetailNotaBeli;
use App\Models\NotaBeli;
use Illuminate\Http\Request;

class DetailNotaBeliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(DetailNotaBeli $detailNotaBeli)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetailNotaBeli $detailNotaBeli)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DetailNotaBeli $detailNotaBeli)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DetailNotaBeli $detailNotaBeli)
    {
        //
    }

    public function productsFromNota($notaID){
        $nota = NotaBeli::with('barangs')->find($notaID);

        return view('transaksi.detailNotaBeli', compact('nota'));
    }
}
