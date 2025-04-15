<?php
namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    // public function run()
    // {
    //     $admin = User::create([
    //         'name'=>'admin',
    //         'username'=>'Admin',
    //         'role'=>'admin',
    //         'email'=>'admin@gmail.com',
    //         'password'=>bcrypt('rahasia')
    //         ]);
    //         $admin->assignRole('admin');
    // }

    public function run()
    {
        $admin = User::create([
            'name' => 'admin',
            'username' => 'Admin',
            'role' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('rahasia')
        ]);

        $admin->assignRole('admin');

        $skpd = User::create([
            'name' => 'DISDIK',
            'username' => 'DISDIK',
            'role' => 'skpd',
            'email' => 'DISDIK@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Dinas Pendidikan Dan Kebudayaan"
        ]);

        $skpd->assignRole('skpd');

        $skpd = User::create([
            'name' => 'DINKES',
            'username' => 'DINKES',
            'role' => 'skpd',
            'email' => 'DINKES@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Dinas Kesehatan"
        ]);

        $skpd->assignRole('skpd');

        $skpd = User::create([
            'name' => 'PUSKESMAS.PADANGBATUNG',
            'username' => 'PUSKESMAS.PADANGBATUNG',
            'role' => 'puskes',
            'email' => 'PUSKESMAS.PADANGBATUNG@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Puskesmas Padang Batung"
        ]);

        $skpd->assignRole('puskes');

        $skpd = User::create([
            'name' => 'PUSKESMAS.KALIRING',
            'username' => 'PUSKESMAS.KALIRING',
            'role' => 'puskes',
            'email' => 'PUSKESMAS.KALIRING@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Puskesmas Kaliring"
        ]);

        $skpd->assignRole('puskes');

        $skpd = User::create([
            'name' => 'PUSKESMAS.MALINAU',
            'username' => 'PUSKESMAS.MALINAU',
            'role' => 'puskes',
            'email' => 'PUSKESMAS.MALINAU@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Puskesmas Malinau"
        ]);

        $skpd->assignRole('puskes');

        $skpd = User::create([
            'name' => 'PUSKESMAS.LOKSADO',
            'username' => 'PUSKESMAS.LOKSADO',
            'role' => 'puskes',
            'email' => 'PUSKESMAS.LOKSADO@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Puskesmas Loksado"
        ]);

        $skpd->assignRole('puskes');

        $skpd = User::create([
            'name' => 'PUSKESMAS.TELAGALANGSAT',
            'username' => 'PUSKESMAS.TELAGALANGSAT',
            'role' => 'puskes',
            'email' => 'PUSKESMAS.TELAGALANGSAT@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Puskesmas Telaga Langsat"
        ]);

        $skpd->assignRole('puskes');


        $skpd = User::create([
            'name' => 'PUSKESMAS.ANGKINANG',
            'username' => 'PUSKESMAS.ANGKINANG',
            'role' => 'puskes',
            'email' => 'PUSKESMAS.ANGKINANG@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Puskesmas Angkinang"
        ]);

        $skpd->assignRole('puskes');


        $skpd = User::create([
            'name' => 'PUSKESMAS.BAMBAN',
            'username' => 'PUSKESMAS.BAMBAN',
            'role' => 'puskes',
            'email' => 'PUSKESMAS.BAMBAN@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Puskesmas Bamban"
        ]);

        $skpd->assignRole('puskes');


        $skpd = User::create([
            'name' => 'PUSKESMAS.KANDANGAN',
            'username' => 'PUSKESMAS.KANDANGAN',
            'role' => 'puskes',
            'email' => 'PUSKESMAS.KANDANGAN@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Puskesmas Kandangan"
        ]);

        $skpd->assignRole('puskes');


        $skpd = User::create([
            'name' => 'PUSKESMAS.GAMBAH',
            'username' => 'PUSKESMAS.GAMBAH',
            'role' => 'puskes',
            'email' => 'PUSKESMAS.GAMBAH@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Puskesmas Gambah"
        ]);

        $skpd->assignRole('puskes');


        $skpd = User::create([
            'name' => 'PUSKESMAS.JAMBUHILIR',
            'username' => 'PUSKESMAS.JAMBUHILIR',
            'role' => 'puskes',
            'email' => 'PUSKESMAS.JAMBUHILIR@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Puskesmas Jambu Hilir"
        ]);

        $skpd->assignRole('puskes');

        $skpd = User::create([
            'name' => 'PUSKESMAS.SUNGAIRAYA',
            'username' => 'PUSKESMAS.SUNGAIRAYA',
            'role' => 'puskes',
            'email' => 'PUSKESMAS.SUNGAIRAYA@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Puskesmas Sungai Raya"
        ]);

        $skpd->assignRole('puskes');


        $skpd = User::create([
            'name' => 'PUSKESMAS.BATANGKULUR',
            'username' => 'PUSKESMAS.BATANGKULUR',
            'role' => 'puskes',
            'email' => 'PUSKESMAS.BATANGKULUR@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Puskesmas Batang Kulur"
        ]);

        $skpd->assignRole('puskes');


        $skpd = User::create([
            'name' => 'PUSKESMAS.SIMPUR',
            'username' => 'PUSKESMAS.SIMPUR',
            'role' => 'puskes',
            'email' => 'PUSKESMAS.SIMPUR@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Puskesmas Simpur"
        ]);

        $skpd->assignRole('puskes');

        $skpd = User::create([
            'name' => 'PUSKESMAS.WASAH',
            'username' => 'PUSKESMAS.WASAH',
            'role' => 'puskes',
            'email' => 'PUSKESMAS.WASAH@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Puskesmas Wasah"
        ]);

        $skpd->assignRole('puskes');

        $skpd = User::create([
            'name' => 'PUSKESMAS.KALUMPANG',
            'username' => 'PUSKESMAS.KALUMPANG',
            'role' => 'puskes',
            'email' => 'PUSKESMAS.KALUMPANG@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Puskesmas Kalumpang"
        ]);

        $skpd->assignRole('puskes');


        $skpd = User::create([
            'name' => 'PUSKESMAS.BAYANAN',
            'username' => 'PUSKESMAS.BAYANAN',
            'role' => 'puskes',
            'email' => 'PUSKESMAS.BAYANAN@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Puskesmas Bayanan"
        ]);

        $skpd->assignRole('puskes');


        $skpd = User::create([
            'name' => 'PUSKESMAS.SUNGAIPINANG',
            'username' => 'PUSKESMAS.SUNGAIPINANG',
            'role' => 'puskes',
            'email' => 'PUSKESMAS.SUNGAIPINANG@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Puskesmas Sungai Pinang"
        ]);

        $skpd->assignRole('puskes');


        $skpd = User::create([
            'name' => 'PUSKESMAS.BARUHJAYA',
            'username' => 'PUSKESMAS.BARUHJAYA',
            'role' => 'puskes',
            'email' => 'PUSKESMAS.BARUHJAYA@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Puskesmas Baruh Jaya"
        ]);

        $skpd->assignRole('puskes');


        $skpd = User::create([
            'name' => 'PUSKESMAS.BAJAYAU',
            'username' => 'PUSKESMAS.BAJAYAU',
            'role' => 'puskes',
            'email' => 'PUSKESMAS.BAJAYAU@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Puskesmas Bajayau"
        ]);

        $skpd->assignRole('puskes');


        $skpd = User::create([
            'name' => 'PUSKESMAS.NEGARA',
            'username' => 'PUSKESMAS.NEGARA',
            'role' => 'puskes',
            'email' => 'PUSKESMAS.NEGARA@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Puskesmas Negara"
        ]);

        $skpd->assignRole('puskes');


        $skpd = User::create([
            'name' => 'PUSKESMAS.PASUNGKAN',
            'username' => 'PUSKESMAS.PASUNGKAN',
            'role' => 'puskes',
            'email' => 'PUSKESMAS.PASUNGKAN@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Puskesmas Pasungkan"
        ]);

        $skpd->assignRole('puskes');


        $skpd = User::create([
            'name' => 'RSUD.DAHASEJAHTERA',
            'username' => 'RSUD.DAHASEJAHTERA',
            'role' => 'puskes',
            'email' => 'RSUD.DAHASEJAHTERA@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "RSUD Daha Sejahtera"
        ]);

        $skpd->assignRole('puskes');



        $skpd = User::create([
            'name' => 'RSUD.HASANBASRY',
            'username' => 'RSUD.HASANBASRY',
            'role' => 'skpd',
            'email' => 'RSUD.HASANBASRY@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "RSUD Brigjend H. Hasan Basry Kandangan"
        ]);

        $skpd->assignRole('skpd');




        $skpd = User::create([
            'name' => 'PUTR',
            'username' => 'PUTR',
            'role' => 'skpd',
            'email' => 'PUTR@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Dinas Pekerjaan Umum Dan Tata Ruang"
        ]);

        $skpd->assignRole('skpd');



        $skpd = User::create([
            'name' => 'DISPERA',
            'username' => 'DISPERA',
            'role' => 'skpd',
            'email' => 'DISPERA@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Dinas Perumahan Rakyat, Kawasan Pemukiman dan Lingkungan Hidup"
        ]);

        $skpd->assignRole('skpd');


        $skpd = User::create([
            'name' => 'SATPOLPP',
            'username' => 'SATPOLPP',
            'role' => 'skpd',
            'email' => 'SATPOLPP@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Satuan Polisi Pamong Praja dan Pemadam Kebakaran"
        ]);

        $skpd->assignRole('skpd');


        $skpd = User::create([
            'name' => 'BPPD',
            'username' => 'BPPD',
            'role' => 'skpd',
            'email' => 'BPPD@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Badan Penanggulangan Bencana Daerah"
        ]);

        $skpd->assignRole('skpd');




        $skpd = User::create([
            'name' => 'DINSOS',
            'username' => 'DINSOS',
            'role' => 'skpd',
            'email' => 'DINSOS@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Dinas Sosial"
        ]);

        $skpd->assignRole('skpd');



        $skpd = User::create([
            'name' => 'DKP',
            'username' => 'DKP',
            'role' => 'skpd',
            'email' => 'DKP@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Dinas Ketahanan Pangan"
        ]);

        $skpd->assignRole('skpd');


        $skpd = User::create([
            'name' => 'DISDUKCAPIL',
            'username' => 'DISDUKCAPIL',
            'role' => 'skpd',
            'email' => 'DISDUKCAPIL@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Dinas Kependudukan Dan Pencatatan Sipil"
        ]);

        $skpd->assignRole('skpd');


        $skpd = User::create([
            'name' => 'DISPMD',
            'username' => 'DISPMD',
            'role' => 'skpd',
            'email' => 'DISPMD@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Dinas Pemberdayaan Masyarakat dan Desa"
        ]);

        $skpd->assignRole('skpd');


        $skpd = User::create([
            'name' => 'DPPKBPPP',
            'username' => 'DPPKBPPP',
            'role' => 'skpd',
            'email' => 'DPPKBPPP@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Dinas Pengendalian Penduduk, Keluarga Berencana, Pemberdayaan Perempuan dan  Perlindungan Anak"
        ]);

        $skpd->assignRole('skpd');



        $skpd = User::create([
            'name' => 'DISHUB',
            'username' => 'DISHUB',
            'role' => 'skpd',
            'email' => 'DISHUB@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Dinas Perhubungan"
        ]);

        $skpd->assignRole('skpd');


        $skpd = User::create([
            'name' => 'DISKOMINFO',
            'username' => 'DISKOMINFO',
            'role' => 'skpd',
            'email' => 'DISKOMINFO@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Dinas Komunikasi dan Informatika"
        ]);

        $skpd->assignRole('skpd');



        $skpd = User::create([
            'name' => 'DISNAKERKOP',
            'username' => 'DISNAKERKOP',
            'role' => 'skpd',
            'email' => 'DISNAKERKOP@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Dinas Tenaga Kerja, Koperasi Usaha Kecil dan Perindustrian"
        ]);

        $skpd->assignRole('skpd');



        $skpd = User::create([
            'name' => 'DPMPTSP',
            'username' => 'DPMPTSP',
            'role' => 'skpd',
            'email' => 'DPMPTSP@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu"
        ]);

        $skpd->assignRole('skpd');


        $skpd = User::create([
            'name' => 'DISPORAPAR',
            'username' => 'DISPORAPAR',
            'role' => 'skpd',
            'email' => 'DISPORAPAR@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Dinas Pemuda Olahraga dan Pariwisata"
        ]);

        $skpd->assignRole('skpd');


        $skpd = User::create([
            'name' => 'DPK',
            'username' => 'DPK',
            'role' => 'skpd',
            'email' => 'DPK@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Dinas Perpustakaan dan Kearsipan"
        ]);

        $skpd->assignRole('skpd');


        $skpd = User::create([
            'name' => 'DISKAN',
            'username' => 'DISKAN',
            'role' => 'skpd',
            'email' => 'DISKAN@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Dinas Perikanan"
        ]);

        $skpd->assignRole('skpd');


        $skpd = User::create([
            'name' => 'DISPERTAN',
            'username' => 'DISPERTAN',
            'role' => 'skpd',
            'email' => 'DISPERTAN@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Dinas Pertanian"
        ]);

        $skpd->assignRole('skpd');


        $skpd = User::create([
            'name' => 'DISPERDAG',
            'username' => 'DISPERDAG',
            'role' => 'skpd',
            'email' => 'DISPERDAG@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Dinas Perdagangan"
        ]);

        $skpd->assignRole('skpd');


        $skpd = User::create([
            'name' => 'SETDA',
            'username' => 'SETDA',
            'role' => 'setda',
            'email' => 'SETDA@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Sekretariat Daerah"
        ]);

        $skpd->assignRole('setda');


        $skpd = User::create([
            'name' => 'BAG.HUKUM',
            'username' => 'BAG.HUKUM',
            'role' => 'setda',
            'email' => 'BAG.HUKUM@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Bagian Hukum"
        ]);

        $skpd->assignRole('setda');


        $skpd = User::create([
            'name' => 'BAG.PEMERINTAHAN',
            'username' => 'BAG.PEMERINTAHAN',
            'role' => 'setda',
            'email' => 'BAG.PEMERINTAHAN@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Bagian Pemerintahan"
        ]);

        $skpd->assignRole('setda');



        $skpd = User::create([
            'name' => 'BAG.PROTOKOL',
            'username' => 'BAG.PROTOKOL',
            'role' => 'setda',
            'email' => 'BAG.PROTOKOL@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Bagian Protokol dan Komunikasi Pimpinan"
        ]);

        $skpd->assignRole('setda');



        $skpd = User::create([
            'name' => 'BAG.KESEJAHTERAANRAKYAT',
            'username' => 'BAG.KESEJAHTERAANRAKYAT',
            'role' => 'setda',
            'email' => 'BAG.KESEJAHTERAANRAKYAT@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Bagian Kesejahteraan Rakyat"
        ]);

        $skpd->assignRole('setda');



        $skpd = User::create([
            'name' => 'BAG.ORGANISASI',
            'username' => 'BAG.ORGANISASI',
            'role' => 'setda',
            'email' => 'BAG.ORGANISASI@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Bagian Organisasi"
        ]);

        $skpd->assignRole('setda');


        $skpd = User::create([
            'name' => 'BAG.UMUM',
            'username' => 'BAG.UMUM',
            'role' => 'setda',
            'email' => 'BAG.UMUM@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Bagian Umum"
        ]);

        $skpd->assignRole('setda');


        $skpd = User::create([
            'name' => 'BAG.PENGADAANBARANGJASA',
            'username' => 'BAG.PENGADAANBARANGJASA',
            'role' => 'setda',
            'email' => 'BAG.PENGADAANBARANGJASA@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Bagian Pengadaan Barang dan Jasa"
        ]);

        $skpd->assignRole('setda');



        $skpd = User::create([
            'name' => 'BAG.PEREKONOMIANPEMBANGUNAN',
            'username' => 'BAG.PEREKONOMIANPEMBANGUNAN',
            'role' => 'setda',
            'email' => 'BAG.PEREKONOMIANPEMBANGUNAN@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Bagian Perekonomian dan Pembangunan"
        ]);

        $skpd->assignRole('setda');


        $skpd = User::create([
            'name' => 'KECAMATAN.SUNGAIRAYA',
            'username' => 'KECAMATAN.SUNGAIRAYA',
            'role' => 'kecamatan',
            'email' => 'KECAMATAN.SUNGAIRAYA@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Kecamatan Sungai Raya"
        ]);

        $skpd->assignRole('kecamatan');



        $skpd = User::create([
            'name' => 'KECAMATAN.PADANGBATUNG',
            'username' => 'KECAMATAN.PADANGBATUNG',
            'role' => 'kecamatan',
            'email' => 'KECAMATAN.PADANGBATUNG@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Kecamatan Padang Batung"
        ]);

        $skpd->assignRole('kecamatan');


        $skpd = User::create([
            'name' => 'KECAMATAN.TELAGALANGSAT',
            'username' => 'KECAMATAN.TELAGALANGSAT',
            'role' => 'kecamatan',
            'email' => 'KECAMATAN.TELAGALANGSAT@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Kecamatan Telaga Langsat"
        ]);

        $skpd->assignRole('kecamatan');


        $skpd = User::create([
            'name' => 'KECAMATAN.ANGKINANG',
            'username' => 'KECAMATAN.ANGKINANG',
            'role' => 'kecamatan',
            'email' => 'KECAMATAN.ANGKINANG@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Kecamatan Angkinang"
        ]);

        $skpd->assignRole('kecamatan');


        $skpd = User::create([
            'name' => 'KECAMATAN.KANDANGAN',
            'username' => 'KECAMATAN.KANDANGAN',
            'role' => 'kecamatan',
            'email' => 'KECAMATAN.KANDANGAN@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Kecamatan Kandangan"
        ]);

        $skpd->assignRole('kecamatan');


        $skpd = User::create([
            'name' => 'KELURAHAN.KANDANGANKOTA',
            'username' => 'KELURAHAN.KANDANGANKOTA',
            'role' => 'kecamatan',
            'email' => 'KELURAHAN.KANDANGANKOTA@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Kelurahan Kandangan Kota"
        ]);

        $skpd->assignRole('kecamatan');


        $skpd = User::create([
            'name' => 'KELURAHAN.KANDANGANBARAT',
            'username' => 'KELURAHAN.KANDANGANBARAT',
            'role' => 'kecamatan',
            'email' => 'KELURAHAN.KANDANGANBARAT@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Kelurahan Kandangan Barat"
        ]);

        $skpd->assignRole('kecamatan');


        $skpd = User::create([
            'name' => 'KELURAHAN.KANDANGANUTARA',
            'username' => 'KELURAHAN.KANDANGANUTARA',
            'role' => 'kecamatan',
            'email' => 'KELURAHAN.KANDANGANUTARA@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Kelurahan Kandangan Utara"
        ]);

        $skpd->assignRole('kecamatan');


        $skpd = User::create([
            'name' => 'KELURAHAN.JAMBUHILIR',
            'username' => 'KELURAHAN.JAMBUHILIR',
            'role' => 'kecamatan',
            'email' => 'KELURAHAN.JAMBUHILIR@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Kelurahan Jambu Hilir"
        ]);

        $skpd->assignRole('kecamatan');


        $skpd = User::create([
            'name' => 'KECAMATAN.SIMPUR',
            'username' => 'KECAMATAN.SIMPUR',
            'role' => 'kecamatan',
            'email' => 'KECAMATAN.SIMPUR@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Kecamatan Simpur"
        ]);

        $skpd->assignRole('kecamatan');

        $skpd = User::create([
            'name' => 'KECAMATAN.DAHASELATAN',
            'username' => 'KECAMATAN.DAHASELATAN',
            'role' => 'kecamatan',
            'email' => 'KECAMATAN.DAHASELATAN@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Kecamatan Daha Selatan"
        ]);

        $skpd->assignRole('kecamatan');


        $skpd = User::create([
            'name' => 'KECAMATAN.DAHAUTARA',
            'username' => 'KECAMATAN.DAHAUTARA',
            'role' => 'kecamatan',
            'email' => 'KECAMATAN.DAHAUTARA@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Kecamatan Daha Utara"
        ]);

        $skpd->assignRole('kecamatan');


        $skpd = User::create([
            'name' => 'KECAMATAN.KALUMPANG',
            'username' => 'KECAMATAN.KALUMPANG',
            'role' => 'kecamatan',
            'email' => 'KECAMATAN.KALUMPANG@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Kecamatan Kalumpang"
        ]);

        $skpd->assignRole('kecamatan');


        $skpd = User::create([
            'name' => 'KECAMATAN.LOKSADO',
            'username' => 'KECAMATAN.LOKSADO',
            'role' => 'kecamatan',
            'email' => 'KECAMATAN.LOKSADO@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Kecamatan Loksado"
        ]);

        $skpd->assignRole('kecamatan');

        $skpd = User::create([
            'name' => 'KECAMATAN.DAHABARAT',
            'username' => 'KECAMATAN.DAHABARAT',
            'role' => 'kecamatan',
            'email' => 'KECAMATAN.DAHABARAT@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Kecamatan Daha Barat"
        ]);

        $skpd->assignRole('kecamatan');



        $skpd = User::create([
            'name' => 'INSPEKTORAT',
            'username' => 'INSPEKTORAT',
            'role' => 'skpd',
            'email' => 'INSPEKTORAT@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Inspektorat Daerah"
        ]);

        $skpd->assignRole('skpd');


        $skpd = User::create([
            'name' => 'BAPPELITBANGDA',
            'username' => 'BAPPELITBANGDA',
            'role' => 'skpd',
            'email' => 'BAPPELITBANGDA@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Badan Perencanaan Pembangunan, Penelitian dan Pengembangan Daerah"
        ]);

        $skpd->assignRole('skpd');



        $skpd = User::create([
            'name' => 'BAKEUDA',
            'username' => 'BAKEUDA',
            'role' => 'skpd',
            'email' => 'BAKEUDA@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Badan Pengelolaan Keuangan dan Pendapatan Daerah"
        ]);

        $skpd->assignRole('skpd');


        // $skpd = User::create([
        //     'name' => 'PPKD',
        //     'username' => 'PPKD',
        //     'role' => 'skpd',
        //     'email' => 'PPKD@gmail.com',
        //     'password' => bcrypt('rahasia'),
        //     "nm_sub_unit" => "PPKD"
        // ]);

        // $skpd->assignRole('skpd');



        $skpd = User::create([
            'name' => 'BKPSDM',
            'username' => 'BKPSDM',
            'role' => 'skpd',
            'email' => 'BKPSDM@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Badan Kepegawaian dan Pengembangan Sumber Daya Manusia"
        ]);

        $skpd->assignRole('skpd');



        $skpd = User::create([
            'name' => 'SEKRETARIATDPRD',
            'username' => 'SEKRETARIATDPRD',
            'role' => 'skpd',
            'email' => 'SEKRETARIATDPRD@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Sekretariat DPRD"
        ]);

        $skpd->assignRole('skpd');


        $skpd = User::create([
            'name' => 'BKBP',
            'username' => 'BKBP',
            'role' => 'skpd',
            'email' => 'BKBP@gmail.com',
            'password' => bcrypt('rahasia'),
            "nm_sub_unit" => "Badan Kesatuan Bangsa dan Politik"
        ]);

        $skpd->assignRole('skpd');


    }
}
