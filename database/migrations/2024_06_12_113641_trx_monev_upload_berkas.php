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
        Schema::create('trx_monev_upload_berkas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('skpd_id');
            $table->unsignedBigInteger('trx_monev_id');
            $table->string('up_1')->nullable();
            $table->string('up_2')->nullable();
            $table->string('up_3')->nullable();
            $table->string('up_4')->nullable();
            $table->string('up_5')->nullable();
            $table->string('up_6')->nullable();
            $table->string('up_7')->nullable();
            $table->string('up_8')->nullable();
            $table->string('up_9')->nullable();
            $table->string('tahun', 4)->default('2022');
            $table->foreign('trx_monev_id')->references('id')->on('trx_monev')->onDelete('cascade');
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
        Schema::dropIfExists('trx_monev_upload_berkas');
    }
};
