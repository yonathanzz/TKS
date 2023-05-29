<?php

namespace App\Http\Controllers;

use App\Models\NotaBeli;
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
        return view('transaksi.pembelian', compact('notabelis'));
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
    public function show(NotaBeli $notaBeli)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NotaBeli $notaBeli)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NotaBeli $notaBeli)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NotaBeli $notaBeli)
    {
        //
    }
}
