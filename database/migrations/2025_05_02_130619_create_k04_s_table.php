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
        if (!Schema::hasTable('k04')) {
            Schema::create('k04', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('skpd_id');
                $table->string('nama_usaha');
                $table->string('no_sertif');
                $table->string('alamat');
                $table->string('hasil');
                $table->string('data_dukung')->nullable(); // boleh kosong
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
        Schema::dropIfExists('k04');
    }
};
