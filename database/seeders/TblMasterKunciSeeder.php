<?php
namespace Database\Seeders;
use App\Models\tbl_master_kunci;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TblMasterKunciSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('tbl_master_kunci')->insert([
            'kunci_realisasi_januari' => '0',
            'kunci_realisasi_februari' => '0',
            'kunci_realisasi_maret' => '0',
            'kunci_realisasi_april' => '0',
            'kunci_realisasi_mei' => '0',
            'kunci_realisasi_juni' => '0',
            'kunci_realisasi_juli' => '0',
            'kunci_realisasi_agustus' => '0',
            'kunci_realisasi_september' => '0',
            'kunci_realisasi_oktober' => '0',
            'kunci_realisasi_november' => '0',
            'kunci_realisasi_desember' => '0',
            'kunci_realisasi_fisik' => '0',
            'kunci_permasalahan' => '0',
            'kunci_rencana' => '0',
            'kunci_pagu' => '0',
            'kunci_pagu_perubahan' => '1',
            'kunci_target' => '0',
        ]);
    }
}
