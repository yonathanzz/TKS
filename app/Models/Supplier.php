<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $table = 'suppliers';
    public $timestamps = false;

    protected $fillable = ['nama', 'no_telp', 'alamat', 'nama_sales', 'no_rekening'];
    public function nota_belis(){
        return $this->hasMany(NotaBeli::class, 'supplier_id');
    }
}
