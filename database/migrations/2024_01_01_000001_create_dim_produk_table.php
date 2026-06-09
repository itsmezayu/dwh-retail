<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('dim_produk', function (Blueprint $table) {
            $table->id('id_produk');
            $table->string('kode_produk', 20)->unique();
            $table->string('nama_produk', 100);
            $table->string('kategori', 50); // Elektronik, Pakaian, Makanan
            $table->decimal('harga', 10, 2);
            $table->timestamps();
        });
    }

    public function down() { Schema::dropIfExists('dim_produk'); }
};
