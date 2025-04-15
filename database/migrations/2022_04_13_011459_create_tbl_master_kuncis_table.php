<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblMasterKuncisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_master_kunci', function (Blueprint $table) {
            $table->id();
            $table->enum('kunci_pagu',[0,1])->default(0);
            $table->enum('kunci_pagu_perubahan',[0,1])->default(0);
            $table->enum('kunci_target',[0,1])->default(0);
            // $table->enum('kunci_target_februari',[0,1])->default(0);
            // $table->enum('kunci_target_maret',[0,1])->default(0);
            // $table->enum('kunci_target_april',[0,1])->default(0);
            // $table->enum('kunci_target_mei',[0,1])->default(0);
            // $table->enum('kunci_target_juni',[0,1])->default(0);
            // $table->enum('kunci_target_juli',[0,1])->default(0);
            // $table->enum('kunci_target_agustus',[0,1])->default(0);
            // $table->enum('kunci_target_september',[0,1])->default(0);
            // $table->enum('kunci_target_oktober',[0,1])->default(0);
            // $table->enum('kunci_target_november',[0,1])->default(0);
            // $table->enum('kunci_target_desember',[0,1])->default(0);
            $table->enum('kunci_realisasi_januari',[0,1])->default(0);
            $table->enum('kunci_realisasi_februari',[0,1])->default(0);
            $table->enum('kunci_realisasi_maret',[0,1])->default(0);
            $table->enum('kunci_realisasi_april',[0,1])->default(0);
            $table->enum('kunci_realisasi_mei',[0,1])->default(0);
            $table->enum('kunci_realisasi_juni',[0,1])->default(0);
            $table->enum('kunci_realisasi_juli',[0,1])->default(0);
            $table->enum('kunci_realisasi_agustus',[0,1])->default(0);
            $table->enum('kunci_realisasi_september',[0,1])->default(0);
            $table->enum('kunci_realisasi_oktober',[0,1])->default(0);
            $table->enum('kunci_realisasi_november',[0,1])->default(0);
            $table->enum('kunci_realisasi_desember',[0,1])->default(0);
            $table->enum('kunci_realisasi_fisik',[0,1])->default(0);
            $table->enum('kunci_permasalahan',[0,1])->default(0);
            $table->enum('kunci_rencana',[0,1])->default(0);
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
        Schema::dropIfExists('tbl_master_kuncis');
    }
}
