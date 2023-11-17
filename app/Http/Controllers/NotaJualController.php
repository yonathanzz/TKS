<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\MetodePembayaran;
use App\Models\NotaJual;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
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
        try {
            $data = new NotaJual();
            $data->tanggal_waktu = now();
            $data->user_id = $request->get('user');
            $data->metode_pembayaran_id = $request->get('metpem');;
            $data->total_bayar = 0; // Initialize total_bayar to 0
            $data->save();

            $productsWithDetails = $request->input('produk', []);

            foreach ($productsWithDetails as $productId => $productInfo) {
                $quantity = $productInfo['jumlah'];
                $hargaSatuan = $productInfo['harga_per_satuan'];

                if ($quantity > 0) {

                    $barang = Barang::find($productId);

                    if ($barang) {

                        $data->barangs()->attach($productId, ['jumlah' => $quantity, 'harga' => $hargaSatuan]);
                        $currentStock = $barang->stok - $quantity;
                        $barang->stok = $currentStock;
                        $barang->save();

                        $data->total_bayar += $quantity * $hargaSatuan;
                    }
                }
            }

            $data->save();

            return redirect()->route('penjualan.index')->with('success', 'Data has been successfully added.');
        } catch (ValidationException $e) {
            // Validation exception occurred, meaning the process failed
            return redirect()->route('penjualan.create')->withErrors($e->errors());
        }
        // $notajual = new NotaJual();

        // $notajual->user_id = $request->input('user');
        // $notajual->metode_pembayaran_id = $request->input('metpem');
        // $notajual->tanggal_waktu = now();

        // // Parse the JSON data from hidden-produk input
        // $produk = json_decode($request->input('produk'), true);

        // $totalBayar = $request->input('totalBayar');

        // // Ensure that the totalBayar is greater than 0
        // if ($totalBayar <= 0) {
        //     return redirect()->route('penjualan.create')->with('error', 'Invalid totalBayar value.');
        // }

        // $notajual->total_bayar = $totalBayar;

        // $notajual->save();

        // foreach ($produk as $item) {
        //     $barang = Barang::where('nama', $item['nama'])->first();

        //     if ($barang) {
        //         $jumlah = $item['jumlah'];

        //         // Ensure that the quantity requested does not exceed available stock
        //         if ($barang->stok >= $jumlah) {
        //             $harga = $item['harga'];
        //             $subtotal = $harga * $jumlah;

        //             // Attach the product to the NotaJual with quantity and price
        //             $notajual->barangs()->attach($barang->id, ['jumlah' => $jumlah, 'harga' => $subtotal]);

        //             // Update the stock
        //             $barang->stok -= $jumlah;
        //             $barang->save();
        //         } else {
        //             // Handle insufficient stock
        //             return redirect()->route('penjualan.create')->with('error', 'Insufficient stock for ' . $item['nama']);
        //         }
        //     } else {
        //         // Handle invalid product
        //         return redirect()->route('penjualan.create')->with('error', 'Invalid product: ' . $item['nama']);
        //     }
        // }

        // return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil ditambahkan.');
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
