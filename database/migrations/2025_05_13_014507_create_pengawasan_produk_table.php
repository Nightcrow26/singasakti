<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    
    {
        if (!Schema::hasTable('pengawasan_produk')) {
            Schema::create('pengawasan_produk', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('skpd_id');
            $table->string('nama');
            $table->date('tanggal_pengawasan');
            $table->enum('kepemilikan_perizinan_berusaha', ['Memiliki', 'Tidak Memiliki'])->default('Tidak Memiliki');
            $table->enum('keabsahan_perizinan_berusaha', ['Sah','Tidak Sah'])->default('Tidak Sah');
            $table->enum('kapasitas_terpasang', ['Sesuai','Tidak Sesuai dengan Perizinan'])->default('Tidak Sesuai dengan Perizinan');
            $table->enum('kepemilikan_bahanbaku', ['Memiliki','Tidak Memiliki'])->default('Tidak Memiliki');
            $table->enum('keabsahan_bahanbaku', ['Sah','Tidak Sah'])->default('Tidak Sah');
            $table->timestamps();
        });
        }
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengawasan_produk');
    }
};
