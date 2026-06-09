<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DimProduk extends Model
{
    protected $table = 'dim_produk';
    protected $primaryKey = 'id_produk';
    protected $guarded = [];

    public function factPenjualan() {
        return $this->hasMany(FactPenjualan::class, 'id_produk', 'id_produk');
    }
}
