<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retur extends Model
{
    use HasFactory;
    protected $table = 'returs';
    public $timestamps = false;
    public function nota_beli()
    {
        return $this->belongsTo(NotaBeli::class);
    }
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
