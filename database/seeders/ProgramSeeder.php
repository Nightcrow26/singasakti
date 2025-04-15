<?php
namespace Database\Seeders;
use App\Models\Program;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/ref_program.json");
        $data = json_decode($json, true);
        foreach ($data['RECORDS'] as $data) {
            Program::create([
                'slug' => $data['slug'],
                'nama' => $data['nama'],
            ]);
        }
    }
}
