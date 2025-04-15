<?php
namespace Database\Seeders;
use App\Models\Kegiatan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class KegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/ref_kegiatan.json");
        $data = json_decode($json, true);
        foreach ($data['RECORDS'] as $data) {
            Kegiatan::create([
                'slug' => $data['slug'],
                'nama' => $data['nama'],
            ]);
        }
    }
}
