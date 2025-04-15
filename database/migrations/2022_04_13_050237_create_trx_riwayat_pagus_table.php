<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrxRiwayatPagusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trx_riwayat_pagu', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('skpd_id');
            $table->unsignedBigInteger('ref_urusan_id');
            $table->unsignedBigInteger('ref_bidang_urusan_id');
            $table->unsignedBigInteger('ref_program_id');
            $table->unsignedBigInteger('ref_kegiatan_id');
            $table->unsignedBigInteger('ref_sub_kegiatan_id');
            $table->unsignedBigInteger('trx_sub_kegiatan_id');
            $table->decimal('riwayat_pagu', 19, 4)->default(0);
            $table->string('riwayat_perubahan')->nullable();
            $table->foreign('trx_sub_kegiatan_id')->references('id')->on('trx_sub_kegiatan')->onDelete('cascade');
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
        Schema::dropIfExists('trx_riwayat_pagus');
    }
}
