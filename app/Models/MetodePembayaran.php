<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodePembayaran extends Model
{
    use HasFactory;
    protected $table = 'metode_pembayarans';
    public $timestamps = false;
    protected $fillable = ['nama'];


    public function nota_juals(){
        return $this->hasMany(NotaJual::class, 'metode_pembayaran_id');
    }

}
