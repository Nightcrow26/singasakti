<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(UrusanSeeder::class);
        $this->call(BidangUrusanSeeder::class);
        $this->call(ProgramSeeder::class);
        $this->call(KegiatanSeeder::class);
        $this->call(SubKegiatanSeeder::class);
        // $this->call(NomenklaturSeeder::class);
        $this->call(TblMasterKunciSeeder::class);

    }
}
