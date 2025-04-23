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
        Schema::create('k02', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('skpd_id');
            $table->string('kegiatan_konstruksi');
            $table->string('no_kontrak');
            $table->string('nm_bujk');
            $table->string('proses_pemilihan_penyedia_jasa');
            $table->string('penerapan_standar_kontrak');
            $table->string('penggunaan_tenaga_kerja_bersertifikat');
            $table->string('pemberian_pekerjaan_utama_subpenyedia');
            $table->string('ketersediaan_dokumen_standar_k4');
            $table->string('penerapan_smkk');
            $table->string('kegiatan_antisipasi_kecelakaan_kerja');
            $table->string('penerapan_sistem_manajemen_mutu_konstruksi');
            $table->string('pemenuhan_peralatan_pelaksanaan_proyek');
            $table->string('penggunaan_material_standar');
            $table->string('penggunaan_produk_dalam_negeri');
            $table->string('pemenuhan_standar_mutu_material');
            $table->string('pemenuhan_standar_teknis_lingkungan');
            $table->string('pemenuhan_standar_k3');
            $table->string('data_dukung')->nullable(); // upload file boleh kosong
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('k02');
    }
};
