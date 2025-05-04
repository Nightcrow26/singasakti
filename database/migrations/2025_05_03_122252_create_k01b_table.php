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
        Schema::create('k01b', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('skpd_id');
            $table->string('nib');
            $table->string('nm_badan_usaha');
            $table->string('pjbu');
            $table->string('jenis');
            $table->string('sifat');
            $table->string('klasifikasi');
            $table->string('layanan');
            $table->string('bentuk');
            $table->string('kualifikasi');
            $table->string('pm_sbu');
            $table->string('pm_nib');
            $table->string('pl_peng_usaha_berkelanjutan');
            $table->string('data_dukung')->nullable(); // upload file boleh kosong
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
        Schema::dropIfExists('k01b');
    }
};
