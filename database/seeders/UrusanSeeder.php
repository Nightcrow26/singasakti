<?php
namespace Database\Seeders;
use App\Models\Urusan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class UrusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/ref_urusan.json");
        $data = json_decode($json, true);
        foreach ($data['RECORDS'] as $data) {
            Urusan::create([
                'slug' => $data['slug'],
                'nama' => $data['nama'],
            ]);
        }
    }
}
