<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengawasanPeralatanTable extends Migration
{
    public function up()
    {
        Schema::create('pengawasan_peralatan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('skpd_id');
            $table->string('nama');
            $table->string('status');
            $table->date('tanggal_pengawasan');
            $table->string('kepemilikan_perizinan_berusaha');
            $table->string('keabsahan_perizinan_berusaha');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengawasan_peralatan');
    }
}
