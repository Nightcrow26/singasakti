<?php
namespace Database\Seeders;
use App\Models\SubKegiatan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class SubKegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/ref_sub_kegiatan.json");
        $data = json_decode($json, true);
        foreach ($data['RECORDS'] as $data) {
            SubKegiatan::create([
                'slug' => $data['slug'],
                'nama' => $data['nama'],
            ]);
        }
    }
}
