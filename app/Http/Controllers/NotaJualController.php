<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\MetodePembayaran;
use App\Models\NotaJual;
use App\Models\User;
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
        $barangs = Barang::all();
        $users = User::all();
        $metode_pembayarans = MetodePembayaran::all();
        return view('transaksi.createPenjualan', compact('barangs', 'users', 'metode_pembayarans'));
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
    public function edit(string $id)
    {
        //
        $notajual = NotaJual::find($id);
        $selUser = $notajual->user;
        $users = User::all();
        $selMetpem = $notajual->metode_pembayaran;
        $metpems = MetodePembayaran::all();
        return view('transaksi.notaJualEdit',compact('notajual', 'selUser','users', 'selMetpem','metpems'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $notajual = NotaJual::find($id);
        $notajual->tanggal_waktu = $notajual->tanggal_waktu;
        $notajual->total_bayar = $request->get('total_bayar');
        $notajual->user_id = $request->get('user_id');
        $notajual->metode_pembayaran_id = $request->get('metode_pembayaran_id');
        $notajual->save();

        return redirect()->route('penjualan.index')->with('status','Your data is already up-to-date');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $obj = NotaJual::find($id);
            $obj->delete();
            return redirect()->route('penjualan.index')->with('status','Data berhasil di hapus');
        }
        catch(\PDOException $ex){
            $msg = "Data Gagal dihapus";
            return redirect()->route('penjualan.index')->with('status',$msg);
        }
    }

    public function addToCart($id){
        $b = Barang::find($id);

        $cart = session()->get('cart');
        if(!isset($cart[$id])){
            $cart[$id] = [
                "name" => $b->nama,
                "quantity" => 1,
                "price" => $b->harga_jual

            ];
        }else{
            $cart[$id]["quantity"]++;
        }
        session()->put('cart',$cart);
        return redirect()->back()->with('success', 'barang berhasil ditambahkan ke nota');
    }
}
