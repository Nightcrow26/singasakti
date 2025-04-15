<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddYearToTrxRiwayatPagu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trx_riwayat_pagu', function (Blueprint $table) {
            //
            $table->string('tahun', 4)->default('2022');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trx_riwayat_pagu', function (Blueprint $table) {
            //
        });
    }
}
