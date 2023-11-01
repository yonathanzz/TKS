<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaBeli extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }
    public function barangs()
    {
        return $this->belongsToMany(Barang::class, 'detail_nota_belis', 'nota_beli_id', 'barang_id')
            ->withPivot('jumlah', 'harga_beli', 'status');
    }
    public function returs()
    {
        return $this->hasMany(Retur::class);
    }
}
