<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DimWaktu extends Model
{
    protected $table = 'dim_waktu';
    protected $primaryKey = 'id_waktu';
    protected $guarded = [];

    public function factPenjualan() {
        return $this->hasMany(FactPenjualan::class, 'id_waktu', 'id_waktu');
    }
}
