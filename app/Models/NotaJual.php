<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaJual extends Model
{
    use HasFactory;

    public function metode_pembayaran(){
        return $this->belongsTo(MetodePembayaran::class, 'metode_pembayaran_id', 'id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
