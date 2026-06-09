<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('fact_penjualan', function (Blueprint $table) {
            $table->id('id_penjualan');
            $table->foreignId('id_produk')->constrained('dim_produk', 'id_produk');
            $table->foreignId('id_pelanggan')->constrained('dim_pelanggan', 'id_pelanggan');
            $table->foreignId('id_waktu')->constrained('dim_waktu', 'id_waktu');
            $table->integer('jumlah');
            $table->decimal('harga_satuan', 10, 2);
            $table->decimal('total_harga', 10, 2);
            $table->timestamps();
        });
    }

    public function down() { Schema::dropIfExists('fact_penjualan'); }
};
