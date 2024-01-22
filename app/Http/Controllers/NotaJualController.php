<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Support\Facades\DB;
use App\Models\MetodePembayaran;
use App\Models\NotaJual;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Cart;

class NotaJualController extends Controller
{
    public function index()
    {
        $penjualans = DB::table('nota_juals')
            ->join('detail_nota_juals', 'nota_juals.id', '=', 'detail_nota_juals.nota_jual_id')
            ->join('barangs', 'barangs.id', '=', 'detail_nota_juals.barang_id')
            ->select('barangs.id', 'barangs.nama', DB::raw('sum(detail_nota_juals.jumlah) as terjual'))
            ->groupBy('barangs.id', 'barangs.nama')
            ->get();
        
        return view('transaksi.laporanPenjualanPerBarang', compact('penjualans'));
    }

    public function getNotaDetailsByBarangId(Request $request)
    {
        $barangId = $request->input('id');
        $penjualans = NotaJual::join('detail_nota_juals', 'nota_juals.id', '=', 'detail_nota_juals.nota_jual_id')
            ->where('detail_nota_juals.barang_id', $barangId)
            ->get();      
        return view('transaksi.penjualanBarang', compact('penjualans'));
    }

    public function create()
    {
        $barangs = Barang::all();
        $users = User::all();
        $metode_pembayarans = MetodePembayaran::all();
        return view('transaksi.createPenjualan', compact('barangs', 'users', 'metode_pembayarans'));
    }

    public function store(Request $request)
    {
        $notajual = new NotaJual();

        $notajual->user_id = $request->input('user');
        $notajual->metode_pembayaran_id = $request->input('metpem');
        $notajual->tanggal_waktu = now();

        $produk = json_decode($request->input('produk'), true);

        $totalBayar = $request->input('totalBayar');

        if ($totalBayar <= 0) {
            return redirect()->route('penjualan.create')->with('error', 'Invalid totalBayar value.');
        }

        $notajual->total_bayar = $totalBayar;

        $notajual->save();

        foreach ($produk as $item) {
            $barang = Barang::where('nama', $item['nama'])->first();

            if ($barang) {
                $jumlah = $item['jumlah'];

                if ($barang->stok >= $jumlah) {
                    $harga = $item['harga'];
                    $subtotal = $harga * $jumlah;
                    $hpp = $item['hpp'];

                    $notajual->barangs()->attach($barang->id, ['jumlah' => $jumlah, 'harga' => $subtotal, 'hpp' => $hpp]);

                    $barang->stok -= $jumlah;
                    $barang->save();
                } else {
                    return redirect()->route('penjualan.create')->with('error', 'Insufficient stock for ' . $item['nama']);
                }
            } else {
                return redirect()->route('penjualan.create')->with('error', 'Invalid product: ' . $item['nama']);
            }
        }

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
