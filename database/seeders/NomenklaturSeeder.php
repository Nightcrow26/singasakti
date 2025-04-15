<?php
namespace Database\Seeders;
use App\Models\Nomenklatur;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class NomenklaturSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $json = File::get("database/data/nomenklatur_perencanaan.json");
        $data = json_decode($json, true);
        foreach ($data['RECORDS'] as $data) {
            Nomenklatur::create([
                'kode_perencanaan' => $data['kode_perencanaan'],
                'parent' => $data['parent'],
                'kodefikasi_ref_urusan' => $data['kodefikasi_ref_urusan'],
                'ref_urusan' => $data['ref_urusan'],
                'kodefikasi_ref_bidang_urusan' => $data['kodefikasi_ref_bidang_urusan'],
                'ref_bidang_urusan' => $data['ref_bidang_urusan'],
                'kodefikasi_ref_program' => $data['kodefikasi_ref_program'],
                'ref_program' => $data['ref_program'],
                'kodefikasi_ref_kegiatan' => $data['kodefikasi_ref_kegiatan'],
                'ref_kegiatan' => $data['ref_kegiatan'],
                'kodefikasi_ref_sub_kegiatan' => $data['kodefikasi_ref_sub_kegiatan'],
                'ref_sub_kegiatan' => $data['ref_sub_kegiatan'],
                'jenis' => $data['jenis'],
            ]);
        }
    }
}
