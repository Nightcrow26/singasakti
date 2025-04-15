<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrxPagusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trx_pagu', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('skpd_id');
            $table->unsignedBigInteger('ref_urusan_id');
            $table->unsignedBigInteger('ref_bidang_urusan_id');
            $table->unsignedBigInteger('ref_program_id');
            $table->unsignedBigInteger('ref_kegiatan_id');
            $table->unsignedBigInteger('ref_sub_kegiatan_id');
            $table->unsignedBigInteger('trx_sub_kegiatan_id');
            $table->decimal('pagu', 19, 4)->default(0);
            $table->decimal('pagu_murni', 19, 4)->default(0);
            $table->decimal('target_januari', 19, 4)->default(0);
            $table->decimal('target_februari', 19, 4)->default(0);
            $table->decimal('target_maret', 19, 4)->default(0);
            $table->decimal('target_april', 19, 4)->default(0);
            $table->decimal('target_mei', 19, 4)->default(0);
            $table->decimal('target_juni', 19, 4)->default(0);
            $table->decimal('target_juli', 19, 4)->default(0);
            $table->decimal('target_agustus', 19, 4)->default(0);
            $table->decimal('target_september', 19, 4)->default(0);
            $table->decimal('target_oktober', 19, 4)->default(0);
            $table->decimal('target_november', 19, 4)->default(0);
            $table->decimal('target_desember', 19, 4)->default(0);
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
        Schema::dropIfExists('trx_pagus');
    }
}
