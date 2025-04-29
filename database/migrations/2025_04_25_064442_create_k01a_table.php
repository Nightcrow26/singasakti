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
        Schema::create('k01a', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('skpd_id');
            $table->string('nib');
            $table->string('nm_usaha_rantai_pasok');
            $table->string('pjbu');
            $table->string('kepemilikan_dan_keabsahan_perizinan_berusaha');
            $table->string('penggunaan_material_peralatan_dan_teknologi');
            $table->string('pencatatan_dalam_simpk');
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
        Schema::dropIfExists('k01a');
    }
};
