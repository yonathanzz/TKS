<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'email', 'password', 'name',
    ];

    public function nota_juals(){
        return $this->hasMany(NotaJual::class, 'user_id');
    }

    public function stock_opnames(){
        return $this->hasMany(StockOpname::class, 'user_id');
    }

    public function barangs(){
        return $this->belongsToMany(Barang::class, 'carts', 'users_id', 'barangs_id')
        ->withPivot('jumlah', 'harga');
    }
}
