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
        Schema::table('trx_monev', function (Blueprint $table) {
            $table->string('nama_perusahaan_perencana')->nullable();
            $table->string('alamat_perusahaan_perencana')->nullable();
            $table->string('nama_direktur_perencana')->nullable();
            $table->string('telpon_perencana')->nullable();
            $table->string('nama_perusahaan_pengawas')->nullable();
            $table->string('alamat_perusahaan_pengawas')->nullable();
            $table->string('nama_direktur_pengawas')->nullable();
            $table->string('telpon_pengawas')->nullable();

        //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trx_monev', function (Blueprint $table) {
        //
        });
    }
};
