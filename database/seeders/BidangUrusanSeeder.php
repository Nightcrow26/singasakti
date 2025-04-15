<?php

namespace Database\Seeders;
use App\Models\BidangUrusan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class BidangUrusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/ref_bidang_urusan.json");
        $data = json_decode($json, true);
        foreach ($data['RECORDS'] as $data) {
            BidangUrusan::create([
                'slug' => $data['slug'],
                'nama' => $data['nama'],
            ]);
        }
    }
}
