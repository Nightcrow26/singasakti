<?php

namespace App\Http\Controllers;

use App\Models\Skpd;
use App\Models\Tahun;
use App\Models\Domain;
use App\Models\trx_mr;
use App\Models\Indikator;
use App\Models\K01A;
use App\Models\K01B;
use App\Models\TrxJawaban;
use Illuminate\Http\Request;
use App\Services\MasterService;
use App\Models\tbl_master_kunci;
use App\Models\trx_upload_berkas;
use App\Models\K02;
use App\Models\K03;
use App\Models\K04;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->service = new MasterService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function indexadmin()
    {
        $data['data'] = trx_mr::where('tahun', auth()->user()->tahun)->get();
        $data['kunci'] = Tahun::where('tahun', auth()->user()->tahun)->first();
        $data['urusan'] = $this->service->getDataUrusan();
        $data['skpd'] = $this->service->getDataSkpd();
        $data['skpd2'] = $this->service->getDataSkpd();

        if (auth()->user()->hasRole('admin')) {
            $data['total_pekerjaan'] = trx_mr::count();
        }
        else {
            $data['total_pekerjaan'] = trx_mr::where('skpd_id', auth()->user()->skpd_id)->count();
        }

        if (auth()->user()->hasRole('admin')) {
            $data['total_lengkap'] = trx_mr::whereHas('berkas', function ($query) {
                $query->whereNotNull('up_1')
                    ->whereNotNull('up_2')
                    ->whereNotNull('up_3')
                    ->whereNotNull('up_4')
                    ->whereNotNull('up_5')
                    ->whereNotNull('up_6')
                    ->whereNotNull('up_7')
                    ->whereNotNull('up_8')
                    ->whereNotNull('up_9');
            })
                ->count();
        }
        else {
            $data['total_lengkap'] = trx_mr::where('skpd_id', auth()->user()->skpd_id)
                ->whereHas('berkas', function ($query) {
                $query->whereNotNull('up_1')
                    ->whereNotNull('up_2')
                    ->whereNotNull('up_3')
                    ->whereNotNull('up_4')
                    ->whereNotNull('up_5')
                    ->whereNotNull('up_6')
                    ->whereNotNull('up_7')
                    ->whereNotNull('up_8')
                    ->whereNotNull('up_9');
            })
                ->count();
        }

        if (auth()->user()->hasRole('admin')) {
            $data['total_tidak_lengkap'] = trx_mr::whereHas('berkas', function ($query) {
                $query->where(function ($q) {
                        $q->whereNull('up_1')
                            ->orWhereNull('up_2')
                            ->orWhereNull('up_3')
                            ->orWhereNull('up_4')
                            ->orWhereNull('up_5')
                            ->orWhereNull('up_6')
                            ->orWhereNull('up_7')
                            ->orWhereNull('up_8')
                            ->orWhereNull('up_9');
                    }
                    );
                })->count();
        }
        else {
            $data['total_tidak_lengkap'] = trx_mr::where('skpd_id', auth()->user()->skpd_id)->whereHas('berkas', function ($query) {
                $query->where(function ($q) {
                        $q->whereNull('up_1')
                            ->orWhereNull('up_2')
                            ->orWhereNull('up_3')
                            ->orWhereNull('up_4')
                            ->orWhereNull('up_5')
                            ->orWhereNull('up_6')
                            ->orWhereNull('up_7')
                            ->orWhereNull('up_8')
                            ->orWhereNull('up_9');
                    }
                    );
                })->count();

        // $data['total_tidak_lengkap'] = trx_mr::where('skpd_id', auth()->user()->skpd_id)
        //     ->with(['berkas' => function ($query) {
        //     $query->where(function ($q) {
        //             $q->orWhereNull('up_1')
        //                 ->orWhereNull('up_2')
        //                 ->orWhereNull('up_3')
        //                 ->orWhereNull('up_4')
        //                 ->orWhereNull('up_5')
        //                 ->orWhereNull('up_6')
        //                 ->orWhereNull('up_7')
        //                 ->orWhereNull('up_8')
        //                 ->orWhereNull('up_9');
        //         }
        //         );
        //     }])
        //     ->count();
        // dd($data['total_tidak_lengkap']);

        }

        if (auth()->user()->hasRole('admin')) {
            $data['total_skpd'] = trx_mr::join('tbl_master_skpd', 'trx_monev.skpd_id', '=', 'tbl_master_skpd.id')
                ->join('trx_monev_upload_berkas', 'trx_monev.id', '=', 'trx_monev_upload_berkas.trx_monev_id') // Adjust the foreign key if necessary
                ->select('tbl_master_skpd.nama')
                ->selectRaw('SUM(CASE WHEN trx_monev_upload_berkas.up_1 IS NOT NULL AND trx_monev_upload_berkas.up_2 IS NOT NULL AND trx_monev_upload_berkas.up_3 IS NOT NULL AND trx_monev_upload_berkas.up_4 IS NOT NULL AND trx_monev_upload_berkas.up_5 IS NOT NULL AND trx_monev_upload_berkas.up_6 IS NOT NULL AND trx_monev_upload_berkas.up_7 IS NOT NULL AND trx_monev_upload_berkas.up_8 IS NOT NULL AND trx_monev_upload_berkas.up_9 IS NOT NULL THEN 1 ELSE 0 END) AS lengkap')
                ->selectRaw('SUM(CASE WHEN trx_monev_upload_berkas.up_1 IS NULL OR trx_monev_upload_berkas.up_2 IS NULL OR trx_monev_upload_berkas.up_3 IS NULL OR trx_monev_upload_berkas.up_4 IS NULL OR trx_monev_upload_berkas.up_5 IS NULL OR trx_monev_upload_berkas.up_6 IS NULL OR trx_monev_upload_berkas.up_7 IS NULL OR trx_monev_upload_berkas.up_8 IS NULL OR trx_monev_upload_berkas.up_9 IS NULL THEN 1 ELSE 0 END) AS tidak_lengkap')
                ->groupBy('tbl_master_skpd.nama')
                ->get();
        }
        else {
            // $data['total_skpd'] = trx_upload_berkas::select('tbl_master_skpd.nama')
            //     ->selectRaw('COUNT(CASE WHEN up_1 IS NOT NULL AND up_2 IS NOT NULL AND up_3 IS NOT NULL AND up_4 IS NOT NULL AND up_5 IS NOT NULL AND up_6 IS NOT NULL AND up_7 IS NOT NULL AND up_8 IS NOT NULL AND up_9 IS NOT NULL THEN 1 END) AS lengkap')
            //     ->selectRaw('COUNT(CASE WHEN up_1 IS NULL OR up_2 IS NULL OR up_3 IS NULL OR up_4 IS NULL OR up_5 IS NULL OR up_6 IS NULL OR up_7 IS NULL OR up_8 IS NULL OR up_9 IS NULL THEN 1 END) AS tidak_lengkap')
            //     ->join('tbl_master_skpd', 'trx_monev_upload_berkas.skpd_id', '=', 'tbl_master_skpd.id')
            //     ->groupBy('tbl_master_skpd.nama')
            //     ->where('skpd_id', auth()->user()->skpd_id)
            //     ->get();

            $data['total_skpd'] = trx_mr::join('tbl_master_skpd', 'trx_monev.skpd_id', '=', 'tbl_master_skpd.id')
                ->join('trx_monev_upload_berkas', 'trx_monev.id', '=', 'trx_monev_upload_berkas.trx_monev_id') // Adjust the foreign key if necessary
                ->select('tbl_master_skpd.nama')
                ->selectRaw('SUM(CASE WHEN trx_monev_upload_berkas.up_1 IS NOT NULL AND trx_monev_upload_berkas.up_2 IS NOT NULL AND trx_monev_upload_berkas.up_3 IS NOT NULL AND trx_monev_upload_berkas.up_4 IS NOT NULL AND trx_monev_upload_berkas.up_5 IS NOT NULL AND trx_monev_upload_berkas.up_6 IS NOT NULL AND trx_monev_upload_berkas.up_7 IS NOT NULL AND trx_monev_upload_berkas.up_8 IS NOT NULL AND trx_monev_upload_berkas.up_9 IS NOT NULL THEN 1 ELSE 0 END) AS lengkap')
                ->selectRaw('SUM(CASE WHEN trx_monev_upload_berkas.up_1 IS NULL OR trx_monev_upload_berkas.up_2 IS NULL OR trx_monev_upload_berkas.up_3 IS NULL OR trx_monev_upload_berkas.up_4 IS NULL OR trx_monev_upload_berkas.up_5 IS NULL OR trx_monev_upload_berkas.up_6 IS NULL OR trx_monev_upload_berkas.up_7 IS NULL OR trx_monev_upload_berkas.up_8 IS NULL OR trx_monev_upload_berkas.up_9 IS NULL THEN 1 ELSE 0 END) AS tidak_lengkap')
                ->where('trx_monev.skpd_id', auth()->user()->skpd_id)
                ->groupBy('tbl_master_skpd.nama')
                ->get();
        }

        if (auth()->user()->hasRole('admin')) {
            $data['realisasi'] = trx_mr::with(['realisasis' => function ($query) {
                $query->orderBy('tgl_realisasi', 'desc');
            }])->get();

            $data['row_hitung'] = trx_mr::count();
        }
        else {
            $data['realisasi'] = trx_mr::where('skpd_id', auth()->user()->skpd_id)->with(['realisasis' => function ($query) {
                $query->orderBy('tgl_realisasi', 'desc');
            }])->get();

            $data['row_hitung'] = trx_mr::where('skpd_id', auth()->user()->skpd_id)->count();
        }

        $isAdmin = auth()->user()->hasRole('admin');
        $userId = auth()->user()->id;

        // Total Semua
        $data['total_k02']  = $isAdmin ? K02::count()  : K02::where('skpd_id', $userId)->count();
        $data['total_k03']  = $isAdmin ? K03::count()  : K03::where('skpd_id', $userId)->count();
        $data['total_k04']  = $isAdmin ? K04::count()  : K04::where('skpd_id', $userId)->count();
        $data['total_k01a'] = $isAdmin ? K01A::count() : K01A::where('skpd_id', $userId)->count();
        $data['total_k01b'] = $isAdmin ? K01B::count() : K01B::where('skpd_id', $userId)->count();
        // Total Lengkap
        $data['total_lengkap_k02'] = ($isAdmin ? K02::query() : K02::where('skpd_id', $userId))
            ->whereNotNull('proses_pemilihan_penyedia_jasa')
            ->whereNotNull('penerapan_standar_kontrak')
            ->whereNotNull('penggunaan_tenaga_kerja_bersertifikat')
            ->whereNotNull('pemberian_pekerjaan_utama_subpenyedia')
            ->whereNotNull('ketersediaan_dokumen_standar_k4')
            ->whereNotNull('penerapan_smkk')
            ->whereNotNull('kegiatan_antisipasi_kecelakaan_kerja')
            ->whereNotNull('penerapan_sistem_manajemen_mutu_konstruksi')
            ->whereNotNull('pemenuhan_peralatan_pelaksanaan_proyek')
            ->whereNotNull('penggunaan_material_standar')
            ->whereNotNull('penggunaan_produk_dalam_negeri')
            ->whereNotNull('pemenuhan_standar_mutu_material')
            ->whereNotNull('pemenuhan_standar_teknis_lingkungan')
            ->whereNotNull('pemenuhan_standar_k3')
            ->count();

        $data['total_lengkap_k03'] = ($isAdmin ? K03::query() : K03::where('skpd_id', $userId))
            ->whereNotNull('kesesuaian_fungsi')
            ->whereNotNull('kesesuaian_lokasi')
            ->whereNotNull('rencana_umur')
            ->whereNotNull('kapasitas_beban')
            ->whereNotNull('pemeliharaan_bangunan')
            ->whereNotNull('program_pemeliharaan')
            ->count();

        $data['total_lengkap_k04'] = ($isAdmin ? K04::query() : K04::where('skpd_id', $userId))
            ->whereNotNull('hasil')->count();
        $data['total_lengkap_k01a'] = ($isAdmin ? K01A::query() : K01A::where('skpd_id', $userId))
            ->whereNotNull('kep_keab_perizinan_berusaha')
            ->whereNotNull('kep_keab_perizinan_teknologi')
            ->whereNotNull('pencatatan_dalam_simpk')
            ->count();

        $data['total_lengkap_k01b'] = ($isAdmin ? K01B::query() : K01B::where('skpd_id', $userId))
            ->whereNotNull('jenis')
            ->whereNotNull('sifat')
            ->whereNotNull('klasifikasi')
            ->whereNotNull('layanan')
            ->whereNotNull('bentuk')
            ->whereNotNull('kualifikasi')
            ->whereNotNull('pm_sbu')
            ->whereNotNull('pm_nib')
            ->whereNotNull('pl_peng_usaha_berkelanjutan')
            ->count();

        // Total Tidak Lengkap (salah satu field kosong)
        $data['total_tidaklengkap_k02'] = ($isAdmin ? K02::query() : K02::where('skpd_id', $userId))
            ->where(function ($q) {
                $q->whereNull('proses_pemilihan_penyedia_jasa')
                ->orWhereNull('penerapan_standar_kontrak')
                ->orWhereNull('penggunaan_tenaga_kerja_bersertifikat')
                ->orWhereNull('pemberian_pekerjaan_utama_subpenyedia')
                ->orWhereNull('ketersediaan_dokumen_standar_k4')
                ->orWhereNull('penerapan_smkk')
                ->orWhereNull('kegiatan_antisipasi_kecelakaan_kerja')
                ->orWhereNull('penerapan_sistem_manajemen_mutu_konstruksi')
                ->orWhereNull('pemenuhan_peralatan_pelaksanaan_proyek')
                ->orWhereNull('penggunaan_material_standar')
                ->orWhereNull('penggunaan_produk_dalam_negeri')
                ->orWhereNull('pemenuhan_standar_mutu_material')
                ->orWhereNull('pemenuhan_standar_teknis_lingkungan')
                ->orWhereNull('pemenuhan_standar_k3');
            })
            ->count();

        $data['total_tidaklengkap_k03'] = ($isAdmin ? K03::query() : K03::where('skpd_id', $userId))
            ->where(function ($q) {
                $q->whereNull('kesesuaian_fungsi')
                ->orWhereNull('kesesuaian_lokasi')
                ->orWhereNull('rencana_umur')
                ->orWhereNull('kapasitas_beban')
                ->orWhereNull('pemeliharaan_bangunan')
                ->orWhereNull('program_pemeliharaan');
            })
            ->count();

        $data['total_tidaklengkap_k04'] = ($isAdmin ? K04::query() : K04::where('skpd_id', $userId))
            ->whereNull('hasil')
            ->count();

        $data['total_tidaklengkap_k01a'] = ($isAdmin ? K01A::query() : K01A::where('skpd_id', $userId))
            ->where(function ($q) {
                $q->whereNull('kep_keab_perizinan_berusaha')
                ->orWhereNull('kep_keab_perizinan_teknologi')
                ->orWhereNull('pencatatan_dalam_simpk');
            })
            ->count();

        $data['total_tidaklengkap_k01b'] = ($isAdmin ? K01B::query() : K01B::where('skpd_id', $userId))
            ->where(function ($q) {
                $q->whereNull('jenis')
                ->orWhereNull('sifat')
                ->orWhereNull('klasifikasi')
                ->orWhereNull('layanan')
                ->orWhereNull('bentuk')
                ->orWhereNull('kualifikasi')
                ->orWhereNull('pm_sbu')
                ->orWhereNull('pm_nib')
                ->orWhereNull('pl_peng_usaha_berkelanjutan');
            })
            ->count();


        return view('home', $data);
    }
}
