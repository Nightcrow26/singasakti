<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblMasterSkpd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_master_skpd', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100)->nullable();
            $table->string('singkatan', 100)->nullable();
            $table->string('code_skpd', 40)->nullable();
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
        Schema::dropIfExists('tbl_master_skpd');
    }
}
