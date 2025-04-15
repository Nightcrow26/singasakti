<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblTrxMr extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trx_monev', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('skpd_id');
            $table->unsignedBigInteger('ref_urusan_id');
            $table->unsignedBigInteger('ref_bidang_urusan_id');
            $table->unsignedBigInteger('ref_program_id');
            $table->unsignedBigInteger('ref_kegiatan_id');
            $table->unsignedBigInteger('ref_sub_kegiatan_id');
            $table->unsignedBigInteger('trx_sub_kegiatan_id');
            $table->string('paket')->nullable();
            $table->decimal('pagu', 19, 4)->default(0);
            $table->decimal('pagu_kontrak', 19, 4)->default(0);
            $table->string('sumber_dana')->nullable();
            $table->date('tgl_kontrak')->nullable();
            $table->date('tgl_mulai')->nullable();
            $table->date('tgl_akhir')->nullable();
            // $table->string('pelaksana')->nullable();
            $table->string('nama_perusahaan')->nullable();
            $table->string('alamat_perusahaan')->nullable();
            $table->string('nama_direktur')->nullable();
            $table->string('telpon')->nullable();
            $table->string('tahun', 4)->default('2022');
            $table->float('latitude', 11, 7);
            $table->float('longitude', 11, 7);
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
        Schema::dropIfExists('trx_monev');
    }
}
