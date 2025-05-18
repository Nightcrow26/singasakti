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
        if (!Schema::hasTable('detail_pengawasan_produk')) {
        Schema::create('detail_pengawasan_produk', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('pengawasan_produk_id');
            $table->string('nama_varian_produk');
            $table->string('nama_sub_varian_produk');
            $table->string('merk_produk');
            $table->enum('sertifikat_tkdn', ['Bersertifikat TKDN','Belum Bersertifikat TKDN'])->default('Belum Bersertifikat TKDN');
            $table->enum('sertifikat_sni', ['Bersertifikat SNI','Belum Bersertifikat SNI'])->default('Belum Bersertifikat SNI');
            $table->enum('pencatatan_simpk', ['Sudah', 'Belum'])->default('Belum');
            $table->string('nomor_registrasi_simpk');

            $table->timestamps();

            $table->foreign('pengawasan_produk_id')->references('id')->on('pengawasan_produk')->onDelete('cascade');
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
        Schema::dropIfExists('detail_pengawasan_produk');
    }
};
