<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    public function nota_juals(){
        return $this->hasMany(NotaJual::class, 'user_id');
    }

    public function stock_opnames(){
        return $this->hasMany(StockOpname::class, 'user_id');
    }
}
