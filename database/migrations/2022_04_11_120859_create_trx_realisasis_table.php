<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrxRealisasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trx_realisasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('skpd_id');
            $table->unsignedBigInteger('ref_urusan_id');
            $table->unsignedBigInteger('ref_bidang_urusan_id');
            $table->unsignedBigInteger('ref_program_id');
            $table->unsignedBigInteger('ref_kegiatan_id');
            $table->unsignedBigInteger('ref_sub_kegiatan_id');
            $table->unsignedBigInteger('trx_sub_kegiatan_id');
            $table->decimal('realisasi_januari', 19, 4)->default(0);
            $table->decimal('realisasi_februari', 19, 4)->default(0);
            $table->decimal('realisasi_maret', 19, 4)->default(0);
            $table->decimal('realisasi_april', 19, 4)->default(0);
            $table->decimal('realisasi_mei', 19, 4)->default(0);
            $table->decimal('realisasi_juni', 19, 4)->default(0);
            $table->decimal('realisasi_juli', 19, 4)->default(0);
            $table->decimal('realisasi_agustus', 19, 4)->default(0);
            $table->decimal('realisasi_september', 19, 4)->default(0);
            $table->decimal('realisasi_oktober', 19, 4)->default(0);
            $table->decimal('realisasi_november', 19, 4)->default(0);
            $table->decimal('realisasi_desember', 19, 4)->default(0);
            $table->decimal('realisasi_fisik_januari', 19, 4)->default(0);
            $table->decimal('realisasi_fisik_februari', 19, 4)->default(0);
            $table->decimal('realisasi_fisik_maret', 19, 4)->default(0);
            $table->decimal('realisasi_fisik_april', 19, 4)->default(0);
            $table->decimal('realisasi_fisik_mei', 19, 4)->default(0);
            $table->decimal('realisasi_fisik_juni', 19, 4)->default(0);
            $table->decimal('realisasi_fisik_juli', 19, 4)->default(0);
            $table->decimal('realisasi_fisik_agustus', 19, 4)->default(0);
            $table->decimal('realisasi_fisik_september', 19, 4)->default(0);
            $table->decimal('realisasi_fisik_oktober', 19, 4)->default(0);
            $table->decimal('realisasi_fisik_november', 19, 4)->default(0);
            $table->decimal('realisasi_fisik_desember', 19, 4)->default(0);
            $table->decimal('tbb_januari', 19, 4)->default(0);
            $table->decimal('tbb_februari', 19, 4)->default(0);
            $table->decimal('tbb_maret', 19, 4)->default(0);
            $table->decimal('tbb_april', 19, 4)->default(0);
            $table->decimal('tbb_mei', 19, 4)->default(0);
            $table->decimal('tbb_juni', 19, 4)->default(0);
            $table->decimal('tbb_juli', 19, 4)->default(0);
            $table->decimal('tbb_agustus', 19, 4)->default(0);
            $table->decimal('tbb_september', 19, 4)->default(0);
            $table->decimal('tbb_oktober', 19, 4)->default(0);
            $table->decimal('tbb_november', 19, 4)->default(0);
            $table->decimal('tbb_desember', 19, 4)->default(0);
            $table->text('permasalahan')->nullable();
            $table->text('rencana')->nullable();
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
        Schema::dropIfExists('trx_realisasis');
    }
}
