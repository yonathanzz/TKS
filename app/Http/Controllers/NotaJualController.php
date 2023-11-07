<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\MetodePembayaran;
use App\Models\NotaJual;
use App\Models\User;
use Illuminate\Http\Request;
use Cart;

class NotaJualController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $penjualans = NotaJual::all();
        return view('transaksi.laporanPenjualan', compact('penjualans'));
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
        $notajual = new NotaJual();

        $notajual->user_id = $request->input('user');
        $notajual->metode_pembayaran_id = $request->input('metpem');
        $notajual->tanggal_waktu = now();
        $notajual->total_bayar = 0;

        $notajual->save();

        $produkWithDetails = $request->input('produk', []);

        $totalBayar = 0;

        foreach ($produkWithDetails as $productId => $productInfo) {
            $jumlah = $productInfo['jumlah'];

            $barang = Barang::find($productId);

            if ($barang && $barang->stok >= $jumlah) {

                $harga = $barang->harga_jual;
                $subtotal = $harga * $jumlah;
                $totalBayar += $subtotal;

                if ($jumlah > 0) {
                    $notajual->barangs()->attach($productId, ['jumlah' => $jumlah, 'harga' => $subtotal]);
                }


                if ($jumlah > 0) {
                    $barang->stok -= $jumlah;
                    $barang->save();
                }

                $barang->save();
            }
        }

        $notajual->total_bayar = $totalBayar;

        $notajual->save();

        return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil ditambahkan.');
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
        return view('transaksi.notaJualEdit', compact('notajual', 'selUser', 'users', 'selMetpem', 'metpems'));
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

        return redirect()->route('penjualan.index')->with('status', 'Your data is already up-to-date');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $obj = NotaJual::find($id);
            $obj->delete();
            return redirect()->route('penjualan.index')->with('status', 'Data berhasil di hapus');
        } catch (\PDOException $ex) {
            $msg = "Data Gagal dihapus";
            return redirect()->route('penjualan.index')->with('status', $msg);
        }
    }

    // public function add(Request $request)
    // {
    //     $product = Barang::find($request->input('barang_id'));

    //     if (!$product) {
    //         return redirect()->route('products.index')->with('error', 'Product not found.');
    //     }

    //     Cart::add([
    //         'id' => $product->id,
    //         'name' => $product->name,
    //         'qty' => $request->input('quantity', 1),
    //         'price' => $product->price,
    //     ]);

    //     return redirect()->route('products.index')->with('success', 'Product added to cart.');
    // }
}
