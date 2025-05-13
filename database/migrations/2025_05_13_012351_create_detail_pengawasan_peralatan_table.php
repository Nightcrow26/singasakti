<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPengawasanPeralatanTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('detail_pengawasan_peralatan')) {
            Schema::create('detail_pengawasan_peralatan', function (Blueprint $table) {
                $table->id();

                $table->unsignedBigInteger('pengawasan_peralatan_id');
                $table->string('nama_varian_peralatan');
                $table->string('nama_sub_varian_peralatan');
                $table->string('merk_peralatan')->nullable();
                $table->integer('jumlah_unit')->default(0);
                $table->string('surat_keterangan_k3')->nullable();
                $table->string('bukti_kepemilikan')->nullable();
                $table->enum('pencatatan_simpk', ['Sudah', 'Belum'])->default('Belum');
                $table->string('nomor_registrasi_simpk')->nullable();

                $table->timestamps();

                $table->foreign('pengawasan_peralatan_id')->references('id')->on('pengawasan_peralatan')->onDelete('cascade');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('detail_pengawasan_peralatan');
    }
}