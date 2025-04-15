<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblTrxRealisasiMr extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trx_realisasi_monev', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('skpd_id');
            $table->unsignedBigInteger('ref_urusan_id');
            $table->unsignedBigInteger('ref_bidang_urusan_id');
            $table->unsignedBigInteger('ref_program_id');
            $table->unsignedBigInteger('ref_kegiatan_id');
            $table->unsignedBigInteger('ref_sub_kegiatan_id');
            $table->unsignedBigInteger('trx_monev_id');
            $table->date('tgl_realisasi')->nullable();
            $table->decimal('realisasi', 19, 4)->default(0);
            $table->decimal('realisasi_fisik', 19, 4)->default(0);
            $table->text('permasalahan')->nullable();
            $table->text('rencana')->nullable();
            $table->string('tahun', 4)->default('2022');
            $table->foreign('trx_monev_id')->references('id')->on('trx_monev')->onDelete('cascade');
            $table->foreign('ref_program_id')->references('id')->on('ref_program')->onDelete('cascade');
            $table->foreign('ref_urusan_id')->references('id')->on('ref_urusan')->onDelete('cascade');
            $table->foreign('ref_bidang_urusan_id')->references('id')->on('ref_bidang_urusan')->onDelete('cascade');
            $table->foreign('ref_sub_kegiatan_id')->references('id')->on('ref_sub_kegiatan')->onDelete('cascade');
            $table->foreign('ref_kegiatan_id')->references('id')->on('ref_kegiatan')->onDelete('cascade');
            $table->foreign('skpd_id')->references('id')->on('tbl_master_skpd')->onDelete('cascade');
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
        Schema::dropIfExists('trx_realisasi_monev');
    }
}
