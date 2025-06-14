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
        Schema::create('pengawasan_distributor', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('skpd_id');
            $table->string('nama');
            $table->date('tanggal_pengawasan');
            $table->enum('kepemilikan_perizinan_berusaha', ['Memiliki', 'Tidak Memiliki'])->default('Tidak Memiliki');
            $table->enum('keabsahan_perizinan_berusaha', ['Sah','Tidak Sah'])->default('Tidak Sah');
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
        Schema::dropIfExists('pengawasan_distributor');
    }
};
