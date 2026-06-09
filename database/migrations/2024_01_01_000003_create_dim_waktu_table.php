<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('dim_waktu', function (Blueprint $table) {
            $table->id('id_waktu');
            $table->date('tanggal');
            $table->integer('tahun');
            $table->integer('bulan');
            $table->string('bulan_nama', 20);
            $table->integer('kuartal');
            $table->timestamps();
        });
    }

    public function down() { Schema::dropIfExists('dim_waktu'); }
};
