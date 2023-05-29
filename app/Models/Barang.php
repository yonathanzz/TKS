<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barangs';
    public $timestamps = false;

    protected $fillable = ['nama', 'stok', 'harga_jual', 'hpp', 'barcode'];

    public function nota_belis(){
        return $this->belongsToMany(NotaBeli::class, 'detail_nota_belis', 'barang_id', 'nota_beli_id')
        ->withPivot('jumlah', 'harga_beli', 'status');
    }

    public function stock_opnames(){
        return $this->belongsToMany(StockOpname::class, 'barangs_stock_opnames', 'barang_id', 'stock_opname_id')
        ->withPivot('stok_real', 'stok_sistem', 'deskripsi');
    }

}
