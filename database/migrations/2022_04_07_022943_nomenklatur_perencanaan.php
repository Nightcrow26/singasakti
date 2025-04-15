<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NomenklaturPerencanaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nomenklatur_perencanaan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_perencanaan',30)->nullable();
            $table->string('parent',30)->nullable();
            $table->string('kodefikasi_ref_urusan',3)->nullable();
            $table->bigInteger('ref_urusan')->nullable();
            $table->string('kodefikasi_ref_bidang_urusan',3)->nullable();
            $table->bigInteger('ref_bidang_urusan')->nullable();
            $table->string('kodefikasi_ref_program',3)->nullable();
            $table->bigInteger('ref_program')->nullable();
            $table->string('kodefikasi_ref_kegiatan',3)->nullable();
            $table->bigInteger('ref_kegiatan')->nullable();
             $table->string('kodefikasi_ref_sub_kegiatan',3)->nullable();
            $table->bigInteger('ref_sub_kegiatan')->nullable();
            $table->enum('jenis',['urusan','bidang_urusan','program','kegiatan','sub_kegiatan'])->nullable();
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
        Schema::dropIfExists('nomenklatur_perencanaan');
    }
}
