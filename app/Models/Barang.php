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

}
