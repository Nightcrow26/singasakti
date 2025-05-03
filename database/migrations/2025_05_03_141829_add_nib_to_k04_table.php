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
        Schema::table('k04', function (Blueprint $table) {
            $table->string('nib')->nullable()->after('id');
        });
    }

    public function down()
    {
        Schema::table('k04', function (Blueprint $table) {
            $table->dropColumn('nib');
        });
    }

};
