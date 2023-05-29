<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOpname extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function barangs(){
        return $this->belongsToMany(Barang::class, 'barangs_stock_opnames', 'stock_opname_id', 'barang_id')
        ->withPivot('stok_real', 'stok_sistem', 'deskripsi');
    }
}
