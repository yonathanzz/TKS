<?php

namespace App\Http\Controllers;

use App\Models\NotaJual;
use Illuminate\Http\Request;

class NotaJualController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $penjualans = NotaJual::all();
        return view('transaksi.penjualan', compact('penjualans'));
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
    public function show(NotaJual $notaJual)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NotaJual $notaJual)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NotaJual $notaJual)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NotaJual $notaJual)
    {
        //
    }
}
