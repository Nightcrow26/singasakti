<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAddressLatitudeLongitudeToUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Menambahkan kolom alamat teks
            $table->text('address')
                  ->nullable()
                  ->after('email');

            // Menambahkan kolom latitude dengan presisi 10,8
            $table->decimal('latitude')
                  ->nullable()
                  ->after('address');

            // Menambahkan kolom longitude dengan presisi 11,8
            $table->decimal('longitude')
                  ->nullable()
                  ->after('latitude');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Menghapus kolom saat rollback
            $table->dropColumn(['address', 'latitude', 'longitude']);
        });
    }
}
