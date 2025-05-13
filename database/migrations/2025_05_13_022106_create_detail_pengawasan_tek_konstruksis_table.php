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
        if (!Schema::hasTable('detail_pengawasan_tek_konstruksi')) {
            Schema::create('detail_pengawasan_tek_konstruksi', function (Blueprint $table) {
                $table->id();

                $table->unsignedBigInteger('pengawasan_tek_konstruksi_id');
                $table->string('nama_teknologi');
                $table->string('bidang_usaha');
                $table->string('haki');
                $table->string('no_haki')->nullable();

                $table->timestamps();

                $table->foreign('pengawasan_tek_konstruksi_id')->references('id')->on('pengawasan_tek_konstruksi')->onDelete('cascade')->name('detail_pengawasan_tek_konstruksi_fk');
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
        Schema::dropIfExists('detail_pengawasan_tek_konstruksi');
    }
};
