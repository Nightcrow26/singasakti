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
        Schema::create('detail_pengawasan_distributor', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('pengawasan_distributor_id');
            $table->string('nama_varian_produk');
            $table->string('nama_sub_varian_produk');
            $table->string('merk_produk');
            $table->enum('sertifikat_tkdn', ['Bersertifikat TKDN','Belum Bersertifikat TKDN'])->default('Belum Bersertifikat TKDN');
            $table->enum('sertifikat_sni', ['Bersertifikat SNI','Belum Bersertifikat SNI'])->default('Belum Bersertifikat SNI');
            $table->enum('pencatatan_simpk', ['Sudah', 'Belum'])->default('Belum');

            $table->timestamps();

            $table->foreign('pengawasan_distributor_id')->references('id')->on('pengawasan_distributor')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_pengawasan_distributor');
    }
};
