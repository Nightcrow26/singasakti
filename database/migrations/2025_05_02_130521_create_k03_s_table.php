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
        if (!Schema::hasTable('k03')) {
            Schema::create('k03', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('skpd_id');
                $table->string('nama_bangunan');
                $table->string('no_kontrak');
                $table->string('lokasi');
                $table->date('tgl_thn_pembangunan');
                $table->date('tgl_thn_pemanfaatan');
                $table->string('umur_konstruksi');
                $table->string('kesesuaian_fungsi');
                $table->string('kesesuaian_lokasi');
                $table->string('rencana_umur');
                $table->string('kapasitas_beban');
                $table->string('pemeliharaan_bangunan');
                $table->string('program_pemeliharaan');
                $table->string('data_dukung')->nullable();
                $table->timestamps();
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
        Schema::dropIfExists('k03');
    }
};
