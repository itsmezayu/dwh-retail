<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DimPelanggan extends Model
{
    protected $table = 'dim_pelanggan';
    protected $primaryKey = 'id_pelanggan';
    protected $guarded = [];

    public function factPenjualan() {
        return $this->hasMany(FactPenjualan::class, 'id_pelanggan', 'id_pelanggan');
    }
}
