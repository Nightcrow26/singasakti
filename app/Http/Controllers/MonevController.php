<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Tahun;
use App\Models\trx_mr;
use Illuminate\Http\Request;
use App\Services\MasterService;
use App\Models\tbl_master_kunci;
use App\Models\trx_realisasi_mr;
use App\Models\trx_sub_kegiatan;
use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\Validator;
use App\Services\MonevService;
use App\Models\trx_monev_foto;
use Yajra\DataTables\Facades\DataTables;
use App\Models\trx_upload;
use App\Models\K02;
use Barryvdh\DomPDF\Facade\Pdf;
class MonevController extends Controller
{
    public function __construct()
    {
        $this->service = new MasterService;
        $this->monev = new MonevService;
    }
    public function index()
    {
        $kunci_realisasi_januari = tbl_master_kunci::pluck('kunci_realisasi_januari');
        $kunci_realisasi_februari = tbl_master_kunci::pluck('kunci_realisasi_februari');
        $kunci_realisasi_maret = tbl_master_kunci::pluck('kunci_realisasi_maret');
        $kunci_realisasi_april = tbl_master_kunci::pluck('kunci_realisasi_april');
        $kunci_realisasi_mei = tbl_master_kunci::pluck('kunci_realisasi_mei');
        $kunci_realisasi_juni = tbl_master_kunci::pluck('kunci_realisasi_juni');
        $kunci_realisasi_juli = tbl_master_kunci::pluck('kunci_realisasi_juli');
        $kunci_realisasi_agustus = tbl_master_kunci::pluck('kunci_realisasi_agustus');
        $kunci_realisasi_september = tbl_master_kunci::pluck('kunci_realisasi_september');
        $kunci_realisasi_oktober = tbl_master_kunci::pluck('kunci_realisasi_oktober');
        $kunci_realisasi_november = tbl_master_kunci::pluck('kunci_realisasi_november');
        $kunci_realisasi_desember = tbl_master_kunci::pluck('kunci_realisasi_desember');
        $kunci_permasalahan = tbl_master_kunci::pluck('kunci_permasalahan');
        $kunci_rencana = tbl_master_kunci::pluck('kunci_rencana');

        // $data['kunci_realisasi'] = $kunci_realisasi[0];
        $data['kunci_realisasi_januari'] = $kunci_realisasi_januari[0];
        $data['kunci_realisasi_februari'] = $kunci_realisasi_februari[0];
        $data['kunci_realisasi_maret'] = $kunci_realisasi_maret[0];
        $data['kunci_realisasi_april'] = $kunci_realisasi_april[0];
        $data['kunci_realisasi_mei'] = $kunci_realisasi_mei[0];
        $data['kunci_realisasi_juni'] = $kunci_realisasi_juni[0];
        $data['kunci_realisasi_juli'] = $kunci_realisasi_juli[0];
        $data['kunci_realisasi_agustus'] = $kunci_realisasi_agustus[0];
        $data['kunci_realisasi_september'] = $kunci_realisasi_september[0];
        $data['kunci_realisasi_oktober'] = $kunci_realisasi_oktober[0];
        $data['kunci_realisasi_november'] = $kunci_realisasi_november[0];
        $data['kunci_realisasi_desember'] = $kunci_realisasi_desember[0];
        $data['kunci_permasalahan'] = $kunci_permasalahan[0];
        $data['kunci_rencana'] = $kunci_rencana[0];

        if (auth()->user()->hasRole('admin')) {
            $data['data'] = trx_mr::with(['realisasis' => function ($query) {
                $query->orderBy('tgl_realisasi', 'desc');
            }])->with('skpd')->get();
        } else {
            $data['data'] = trx_mr::where('skpd_id', auth()->user()->skpd_id)->with(['realisasis' => function ($query) {
                $query->orderBy('tgl_realisasi', 'desc');
            }])->with('skpd')->get();
        }



        $data['kunci'] = Tahun::where('tahun', auth()->user()->tahun)->first();
        $data['urusan'] = $this->service->getDataUrusan();
        $data['skpd'] = $this->service->getDataSkpd();
        $data['skpd2'] = $this->service->getDataSkpd();

        // dd($data['data']);
        return view('admin.monev.index', $data);
    }

    public function detail($id)
    {
        $realisasi = trx_realisasi_mr::where('trx_monev_id', $id)->first();
        $data['data'] = trx_mr::with(['realisasi' => function ($query) {
            $query->orderBy('tgl_realisasi', 'desc')->get();
        }])->with('skpd')->where('id', $id)->first();
        return view('admin.monev.detail', $data);
    }

    public function detailfoto($id)
    {
        $data['data'] = trx_realisasi_mr::where('id', $id)->first();
        $data['foto'] = trx_monev_foto::where('trx_realisasi_monev_id', $id)->get();
        return view('admin.monev.detail-foto', $data);
    }

    public function add($id)
    {


        $data['realisasi'] = trx_realisasi_mr::where('trx_monev_id', $id)->orderBy('tgl_realisasi', 'ASC')->get();
        $data['data'] = trx_mr::where('id', $id)->first();
        $data['id'] = $id;
        // $data['foto'] = trx_monev_foto::where('trx_monev_id', $id)->get();
        return view('admin.monev.add', $data);
    }

    public function edit($id)
    {
        $data['id'] = $id;
        $data['urusan'] = $this->service->getDataUrusan();
        $data['skpd'] = $this->service->getDataSkpd();
        $data['data'] = trx_mr::where('id', $id)->first();
        $get = trx_mr::where('id', $id)->first();
        $data['urusan_select'] = $this->service->getDataUrusan($get->ref_urusan_id);
        $data['bidang_select'] = $this->service->getDataBidang($get->ref_bidang_urusan_id);
        $data['program_select'] = $this->service->getDataProgram($get->ref_program_id);
        $data['kegiatan_select'] = $this->service->getDataKegiatan($get->ref_kegiatan_id);
        $data['sub_select'] = $this->service->getDataSub($get->ref_sub_kegiatan_id);
        $data['skpd_select'] = $this->service->getDataSkpd($get->skpd_id);
        // dd($get);

        return view('admin.monev.edit', $data);
    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {

            $urusan = DB::table('trx_urusan')->insertGetId([
                 'skpd_id' => $request->input('skpd_id'),
                'tahun' => auth()->user()->tahun,
                'ref_urusan_id' => $request->input('ref_urusan_id'),
                "created_at" => \Carbon\Carbon::now(), # new \Datetime()
                "updated_at" => \Carbon\Carbon::now(), # new \Datetime()
            ]);

            $bidang_urusan = DB::table('trx_bidang_urusan')->insertGetId([
                 'skpd_id' => $request->input('skpd_id'),
                'tahun' => auth()->user()->tahun,
                'trx_urusan_id' => $urusan,
                'ref_urusan_id' => $request->input('ref_urusan_id'),
                'ref_bidang_urusan_id' => $request->input('ref_bidang_urusan_id'),
                "created_at" => \Carbon\Carbon::now(), # new \Datetime()
                "updated_at" => \Carbon\Carbon::now(), # new \Datetime()
            ]);


            $program = DB::table('trx_program')->insertGetId([
                 'skpd_id' => $request->input('skpd_id'),
                'tahun' => auth()->user()->tahun,
                'trx_bidang_urusan_id' => $bidang_urusan,
                'ref_urusan_id' => $request->input('ref_urusan_id'),
                'ref_bidang_urusan_id' => $request->input('ref_bidang_urusan_id'),
                'ref_program_id' => $request->input('ref_program_id'),
                "created_at" => \Carbon\Carbon::now(), # new \Datetime()
                "updated_at" => \Carbon\Carbon::now(), # new \Datetime()
            ]);

            $kegiatan = DB::table('trx_kegiatan')->insertGetId([
                 'skpd_id' => $request->input('skpd_id'),
                'tahun' => auth()->user()->tahun,
                'trx_program_id' => $program,
                'ref_urusan_id' => $request->input('ref_urusan_id'),
                'ref_bidang_urusan_id' => $request->input('ref_bidang_urusan_id'),
                'ref_program_id' => $request->input('ref_program_id'),
                'ref_kegiatan_id' => $request->input('ref_kegiatan_id'),
                "created_at" => \Carbon\Carbon::now(), # new \Datetime()
                "updated_at" => \Carbon\Carbon::now(), # new \Datetime()
            ]);

            $sub_kegiatan = DB::table('trx_sub_kegiatan')->insertGetId([
                 'skpd_id' => $request->input('skpd_id'),
                'tahun' => auth()->user()->tahun,
                'trx_kegiatan_id' => $kegiatan,
                'ref_urusan_id' => $request->input('ref_urusan_id'),
                'ref_bidang_urusan_id' => $request->input('ref_bidang_urusan_id'),
                'ref_program_id' => $request->input('ref_program_id'),
                'ref_kegiatan_id' => $request->input('ref_kegiatan_id'),
                'ref_sub_kegiatan_id' => $request->input('ref_sub_kegiatan_id'),
                "created_at" => \Carbon\Carbon::now(), # new \Datetime()
                "updated_at" => \Carbon\Carbon::now(), # new \Datetime()
            ]);

            $realisasi = DB::table('trx_realisasi')->insertGetId([
                 'skpd_id' => $request->input('skpd_id'),
                'tahun' => auth()->user()->tahun,
                'trx_sub_kegiatan_id' => $sub_kegiatan,
                'ref_urusan_id' => $request->input('ref_urusan_id'),
                'ref_bidang_urusan_id' => $request->input('ref_bidang_urusan_id'),
                'ref_program_id' => $request->input('ref_program_id'),
                'ref_kegiatan_id' => $request->input('ref_kegiatan_id'),
                'ref_sub_kegiatan_id' => $request->input('ref_sub_kegiatan_id'),
                "created_at" => \Carbon\Carbon::now(), # new \Datetime()
                "updated_at" => \Carbon\Carbon::now(), # new \Datetime()
            ]);

            $pagu = DB::table('trx_pagu')->insertGetId([
                 'skpd_id' => $request->input('skpd_id'),
                'tahun' => auth()->user()->tahun,
                'trx_sub_kegiatan_id' => $sub_kegiatan,
                'ref_urusan_id' => $request->input('ref_urusan_id'),
                'ref_bidang_urusan_id' => $request->input('ref_bidang_urusan_id'),
                'ref_program_id' => $request->input('ref_program_id'),
                'ref_kegiatan_id' => $request->input('ref_kegiatan_id'),
                'ref_sub_kegiatan_id' => $request->input('ref_sub_kegiatan_id'),
                "created_at" => \Carbon\Carbon::now(), # new \Datetime()
                "updated_at" => \Carbon\Carbon::now(), # new \Datetime()
            ]);

            $daterangeData = $request->input('daterange');
            $dates = explode(' - ', $daterangeData);
            $tgl_mulai = Carbon::parse($dates[0])->toDateString();
            $tgl_akhir = Carbon::parse($dates[1])->toDateString();
            $tgl_mulai_plus_satu = Carbon::parse($dates[0])->addDays(1)->toDateString();
            $monev = DB::table('trx_monev')->insertGetId([
                 'skpd_id' => $request->input('skpd_id'),
                'tahun' => auth()->user()->tahun,
                'trx_sub_kegiatan_id' => $sub_kegiatan,
                'ref_urusan_id' => $request->input('ref_urusan_id'),
                'ref_bidang_urusan_id' => $request->input('ref_bidang_urusan_id'),
                'ref_program_id' => $request->input('ref_program_id'),
                'ref_kegiatan_id' => $request->input('ref_kegiatan_id'),
                'ref_sub_kegiatan_id' => $request->input('ref_sub_kegiatan_id'),
                'paket' => $request->input('paket'),
                'pagu' => $request->input('pagu'),
                'pagu_kontrak' => $request->input('pagu_kontrak'),
                'sumber_dana' => $request->input('sumber_dana'),
                'tgl_kontrak' => $request->input('tgl_kontrak'),
                'tgl_mulai' => $tgl_mulai,
                'tgl_akhir' => $tgl_akhir,
                'nama_perusahaan' => $request->input('nama_perusahaan'),
                'alamat_perusahaan' => $request->input('alamat_perusahaan'),
                'nama_direktur' => $request->input('nama_direktur'),
                'telpon' => $request->input('telpon'),
                'nama_perusahaan_perencana' => $request->input('nama_perusahaan_perencana'),
                'alamat_perusahaan_perencana' => $request->input('alamat_perusahaan_perencana'),
                'nama_direktur_perencana' => $request->input('nama_direktur_perencana'),
                'telpon_perencana' => $request->input('telpon_perencana'),
                'nama_perusahaan_pengawas' => $request->input('nama_perusahaan_pengawas'),
                'alamat_perusahaan_pengawas' => $request->input('alamat_perusahaan_pengawas'),
                'nama_direktur_pengawas' => $request->input('nama_direktur_pengawas'),
                'telpon_pengawas' => $request->input('telpon_pengawas'),
                'latitude' => $request->input('latitude'),
                'longitude' => $request->input('longitude'),
                "created_at" => \Carbon\Carbon::now(), # new \Datetime()
                "updated_at" => \Carbon\Carbon::now(), # new \Datetime()
            ]);

            $realisasi = DB::table('trx_realisasi_monev')->insertGetId([
                'skpd_id' => $request->input('skpd_id'),
                'tahun' => auth()->user()->tahun,
                'trx_monev_id' => $monev,
                'ref_urusan_id' => $request->input('ref_urusan_id'),
                'ref_bidang_urusan_id' => $request->input('ref_bidang_urusan_id'),
                'ref_program_id' => $request->input('ref_program_id'),
                'ref_kegiatan_id' => $request->input('ref_kegiatan_id'),
                'ref_sub_kegiatan_id' => $request->input('ref_sub_kegiatan_id'),
                'tgl_realisasi' => $tgl_mulai_plus_satu,
                "created_at" => \Carbon\Carbon::now(), # new \Datetime()
                "updated_at" => \Carbon\Carbon::now(), # new \Datetime()
            ]);

            $berkas = DB::table('trx_monev_upload_berkas')->insertGetId([
                'skpd_id' => $request->input('skpd_id'),
                'tahun' => auth()->user()->tahun,
                'trx_monev_id' => $monev,
                "created_at" => \Carbon\Carbon::now(), # new \Datetime()
                "updated_at" => \Carbon\Carbon::now(), # new \Datetime()
            ]);

        });
        return response()->json(true);
    }

    public function update(Request $request)
    {
        $will_insert = $request->except(['_token','daterange', '_method']);
        $daterangeData = $request->input('daterange');
        $dates = explode(' - ', $daterangeData);
        $will_insert['tgl_mulai'] = Carbon::parse($dates[0])->toDateString();
        $will_insert['tgl_akhir'] = Carbon::parse($dates[1])->toDateString();
        $skpd = trx_mr::where('id', $request->input('id'))->update($will_insert);
        return response()->json(true);
    }

    public function showrealisasi(Request $request)
    {
        $trx = trx_mr::where('id', $request->input('id'))->first();
        $realisasi = trx_realisasi_mr::where('trx_monev_id', $request->input('id'))->first();
        $pagu_get = $trx->pagu;
        $pagu_kontrak_get =  $trx->pagu_kontrak;
        $pagu_num = number_format($pagu_get, 0, ',', '.');
        $pagu_kontrak_num = number_format($pagu_kontrak_get, 0, ',', '.');
        return response()->json([
            'rencana' => $trx->rencana,
            'permasalahan' => $trx->permasalahan,
            'paket' => $trx->paket,
            'skpd_id' => $trx->skpd_id,
            'ref_urusan_id' => $trx->ref_urusan_id,
            'ref_bidang_urusan_id' => $trx->ref_bidang_urusan_id,
            'ref_program_id' => $trx->ref_program_id,
            'ref_kegiatan_id' => $trx->ref_kegiatan_id,
            'ref_sub_kegiatan_id' => $trx->ref_sub_kegiatan_id,
            'tgl_realisasi' => $trx->tgl_realisasi,
            'pagu' => $pagu_num,
            'pagu_kontrak' => $pagu_kontrak_num,
        ]);
    }

    public function showfile(Request $request)
    {
        $data['data'] = trx_mr::where('id', $request->input('id'))->first();
        $data['file'] = trx_upload::where('trx_monev_id', $request->input('id'))->get();
        return view('admin.monev.index-upload',$data);
    }

    public function showrealisasiedit(Request $request)
    {

        $trx = trx_realisasi_mr::where('id', $request->input('id'))->first();


        $realisasi_fisik_get = $trx->realisasi_fisik;
        $realisasi_get = $trx->realisasi;


        $realisasi= number_format($realisasi_get, 0, ',', '');
        $realisasi_fisik= number_format($realisasi_fisik_get, 0, ',', '');

        return response()->json([
            'realisasi' => $realisasi,
            'realisasi_fisik' => $realisasi_fisik,
            'tgl_realisasi' => $trx->tgl_realisasi,
            'skpd_id' => $trx->skpd_id,
        ]);
    }


    public function storerealisasi(Request $request)
    {
        //
        $will_insert = $request->except(['realisasi', 'realisasi_fisik', 'pagu', 'pagu_sub', 'total_pagu', '_token', '_method']);

        //  $pagu = (float) $request->input('pagu');
        $realisasi = (float) $request->input('realisasi');


        $realisasi_fisik = (float) $request->input('realisasi_fisik');


        //  $will_insert['pagu'] = $pagu;
        $will_insert['realisasi'] = $realisasi;


        $will_insert['realisasi_fisik'] = $realisasi_fisik;


        $pagu = trx_mr::where('id', $request->input('trx_monev_id'))->first();
        $pagu_float = (float) $pagu->pagu;


        if ($realisasi > $pagu_float) {
            return response()->json('realisasi_melebihi');
        } elseif ($realisasi_fisik  > 100) {
            return response()->json('fisik_melebihi');
        } else {
            DB::transaction(function () use ($request) {
                $realisasi = DB::table('trx_realisasi_monev')->insertGetId([
                    'skpd_id' => $request->input('skpd_id'),
                    'tahun' => auth()->user()->tahun,
                    'realisasi' => $request->input('realisasi'),
                    'realisasi_fisik' => $request->input('realisasi_fisik'),
                    'tgl_realisasi' => $request->input('tgl_realisasi'),
                    'trx_monev_id' => $request->input('trx_monev_id'),
                    'ref_urusan_id' => $request->input('ref_urusan_id'),
                    'ref_bidang_urusan_id' => $request->input('ref_bidang_urusan_id'),
                    'ref_program_id' => $request->input('ref_program_id'),
                    'ref_kegiatan_id' => $request->input('ref_kegiatan_id'),
                    'ref_sub_kegiatan_id' => $request->input('ref_sub_kegiatan_id'),
                    "created_at" => \Carbon\Carbon::now(), # new \Datetime()
                    "updated_at" => \Carbon\Carbon::now(), # new \Datetime()
                ]);

                if ($request->hasFile('foto')) {
                    foreach ($request->file('foto') as $i => $file) {
                        trx_monev_foto::create([
                            'skpd_id' => $request->input('skpd_id'),
                            'trx_realisasi_monev_id' => $realisasi,
                            'ket' => $request->input('ket'),
                            'tahun' => $request->input('tahun'),
                            'original_name' => $file->getClientOriginalName(),
                            'foto' => $file->store('foto', 'public'),
                        ]);
                    }
                }
            });
            // $skpd = trx_realisasi_mr::where('trx_monev_id', $request->input('trx_monev_id'))->update($will_insert);
            return response()->json(true);
        }
    }

    public function updaterealisasi(Request $request)
    {
        //
        $will_insert = $request->except(['realisasi', 'realisasi_fisik', 'pagu', 'pagu_sub', 'total_pagu', '_token', '_method']);

        //  $pagu = (float) $request->input('pagu');
        $realisasi = (float) $request->input('realisasi');


        $realisasi_fisik = (float) $request->input('realisasi_fisik');


        //  $will_insert['pagu'] = $pagu;
        $will_insert['realisasi'] = $realisasi;


        $will_insert['realisasi_fisik'] = $realisasi_fisik;


        $pagu = trx_mr::where('id', $request->input('trx_monev_id'))->first();
        $pagu_float = (float) $pagu->pagu;


        if ($realisasi > $pagu_float) {
            return response()->json('realisasi_melebihi');
        } elseif ($realisasi_fisik  > 100) {
            return response()->json('fisik_melebihi');
        } else {
            DB::transaction(function () use ($request) {
                $realisasi = DB::table('trx_realisasi_monev')->where('id',$request->input('id'))->update([
                    'realisasi' => $request->input('realisasi'),
                    'realisasi_fisik' => $request->input('realisasi_fisik'),
                    'tgl_realisasi' => $request->input('tgl_realisasi'),
                    "created_at" => \Carbon\Carbon::now(), # new \Datetime()
                    "updated_at" => \Carbon\Carbon::now(), # new \Datetime()
                ]);

                if ($request->hasFile('foto')) {
                    foreach ($request->file('foto') as $i => $file) {
                        trx_monev_foto::create([
                            'skpd_id' => $request->input('skpd_id'),
                            'trx_realisasi_monev_id' => $request->input('id'),
                            'ket' => $request->input('ket'),
                            'tahun' => $request->input('tahun'),
                            'original_name' => $file->getClientOriginalName(),
                            'foto' => $file->store('foto', 'public'),
                        ]);
                    }
                }
            });
            // $skpd = trx_realisasi_mr::where('trx_monev_id', $request->input('trx_monev_id'))->update($will_insert);
            return response()->json(true);
        }
    }


    public function delete(Request $request)
    {
        trx_mr::where('id', $request->input('id'))->delete();

        return response()->json(true);
    }

    public function deletefoto(Request $request)
    {
        trx_monev_foto::where('id', $request->input('id'))->delete();

        return response()->json(true);
    }

    public function deletefile(Request $request)
    {
        trx_upload::where('id', $request->input('id'))->delete();

        return response()->json(true);
    }

    public function deleterealisasi(Request $request)
    {
        trx_realisasi_mr::where('id', $request->input('id'))->delete();

        return response()->json(true);
    }

    public function marker(Request $request)
    {

        if (auth()->user()->hasRole('admin')) {
            $query = trx_mr::with(['realisasi' => function ($query) {
                $query->orderBy('tgl_realisasi', 'desc');
            }])->with('skpd')->where('tahun', auth()->user()->tahun);

            if ($request->has('skpd_id') && $request->skpd_id != '') {
                $query->where('skpd_id', $request->skpd_id);
            }

            $markers = $query->get();

            // $markers = trx_mr::with(['realisasi' => function ($query) {
            //     $query->orderBy('tgl_realisasi', 'desc');
            // }])->with('skpd')->where('tahun', auth()->user()->tahun)->get();
        }
        else {
            $markers = trx_mr::where('skpd_id', auth()->user()->skpd_id)->with(['realisasi' => function ($query) {
                $query->orderBy('tgl_realisasi', 'desc');
            }])->with('skpd')->where('tahun', auth()->user()->tahun)->get();
        }


        // dd($markers);
        return response()->json($markers);
    }

    public function storefoto(Request $request)
    {
        // dd($request->input());
        $validator = Validator::make(request()->all(), [
            'foto.*' => 'nullable|file|max:2048|mimes:png,jpg,jpeg',
        ],
        [
            'foto.*.max' => 'Ukuran file tidak boleh melebihi 2MB.',
            'foto.*.mimes' => 'File Harus Berupa Gambar',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => "failed",
                "message" => $validator->errors()->first(),
            ]);
        }
        else {
            $store = $this->monev->storeFoto($request);
            if ($store == true) {
                return response()->json([
                    "status" => "success",
                    "messages" => "Berhasil Menambahkan Data",

                ]);
            }
            else {
                return response()->json([
                    "status" => "failed",
                    "messages" => "Gagal Menambahkan Data",
                ]);
            }
        }
    }

    public function indextable()
    {
        $data['urusan'] = $this->service->getDataUrusan();
        $data['skpd'] = $this->service->getDataSkpd();

        // dd($data['data']);
        return view('admin.monev.table.index', $data);
    }

    public function k02()
    {
        // Mengambil semua data K02
        $dataK02 = K02::all(); 

        // Kirim data ke view
        return view('admin.monev.k02.index', compact('dataK02'));
    }
    public function insertDatak02(Request $request)
    {
        // Validasi data dulu
        $data = $request->validate([
            'skpd_id' => 'required|integer',
            'kegiatan_konstruksi' => 'required|string|max:255',
            'no_kontrak' => 'required|string|max:255',
            'nm_bujk' => 'required|string|max:255',
            'proses_pemilihan_penyedia_jasa' => 'required|string',
            'penerapan_standar_kontrak' => 'required|string',
            'penggunaan_tenaga_kerja_bersertifikat' => 'required|string',
            'pemberian_pekerjaan_utama_subpenyedia' => 'required|string',
            'ketersediaan_dokumen_standar_k4' => 'required|string',
            'penerapan_smkk' => 'required|string',
            'kegiatan_antisipasi_kecelakaan_kerja' => 'required|string',
            'penerapan_sistem_manajemen_mutu_konstruksi' => 'required|string',
            'pemenuhan_peralatan_pelaksanaan_proyek' => 'required|string',
            'penggunaan_material_standar' => 'required|string',
            'penggunaan_produk_dalam_negeri' => 'required|string',
            'pemenuhan_standar_mutu_material' => 'required|string',
            'pemenuhan_standar_teknis_lingkungan' => 'required|string',
            'pemenuhan_standar_k3' => 'required|string',
            'data_dukung' => 'nullable|file|mimes:pdf|max:5120', // <<< di sini dibatasi maksimal 5MB
        ]);
        // Mulai transaksi
        DB::beginTransaction();

        try {
            // Upload file dulu
            if ($request->hasFile('data_dukung')) {
                $file = $request->file('data_dukung');
            
                // Bikin nama file unik
                $namaFile = uniqid() . '.' . $file->getClientOriginalExtension();
            
                // Pindahkan file ke folder public/uploads/data_dukung
                $file->move(public_path('uploads/data_dukung'), $namaFile);
            
                // Simpan path untuk ke database (tanpa "public/")
                $data['data_dukung'] = $namaFile;
            } else {
                $data['data_dukung'] = null;
            }
            

            // Insert ke database
            $k02 = K02::create($data);
            // Commit transaksi jika sukses
            DB::commit();
            
            return redirect()->back()->with('success', 'Data berhasil disimpan!');

        } catch (\Exception $e) {
            // Rollback transaksi jika ada error
            DB::rollBack();
            // Kalau ada error apapun
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    } //DONE
    public function updatek02(Request $request)
    {
        try {
            // Validasi form
            $data = $request->validate([
                'id' => 'required|integer',
                'kegiatan_konstruksi' => 'required|string|max:255',
                'no_kontrak' => 'required|string|max:255',
                'nm_bujk' => 'required|string|max:255',
                'proses_pemilihan_penyedia_jasa' => 'required|string',
                'penerapan_standar_kontrak' => 'required|string',
                'penggunaan_tenaga_kerja_bersertifikat' => 'required|string',
                'pemberian_pekerjaan_utama_subpenyedia' => 'required|string',
                'ketersediaan_dokumen_standar_k4' => 'required|string',
                'penerapan_smkk' => 'required|string',
                'kegiatan_antisipasi_kecelakaan_kerja' => 'required|string',
                'data_dukung' => 'nullable|file|mimes:pdf|max:5120', // Max 5MB
            ]);

            DB::beginTransaction(); // Mulai transaksi database

            // Cari data lama berdasarkan ID
            $item = K02::findOrFail($request->input('id'));

            // Jika ada file baru di-upload
            if ($request->hasFile('data_dukung')) {
                // Hapus file lama jika ada
                if ($item->data_dukung) {
                    $oldFilePath = public_path('uploads/data_dukung/' . $item->data_dukung);
                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath);
                    }
                }

                // Simpan file baru
                $file = $request->file('data_dukung');
                $namaFile = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/data_dukung'), $namaFile);

                $data['data_dukung'] = $namaFile;
            } else {
                // Kalau tidak upload file baru, jangan timpa file lama
                unset($data['data_dukung']);
            }

            // Update data ke database
            $item->update($data);

            DB::commit(); // Simpan transaksi

            // Redirect dengan pesan sukses
            return redirect()->back()->with('success', 'Data berhasil diperbarui');

        } catch (\Exception $e) {
            DB::rollBack(); // Gagal, rollback transaksi
            // Redirect dengan pesan error
            return redirect()->back()->with('error', 'Gagal memperbarui data.'. $e->getMessage());
        }
    } //DONE
    public function updatek02bawah(Request $request)
    {
        try {
            // Validasi form
            $data = $request->validate([
                'id' => 'required|integer',
                'kegiatan_konstruksi' => 'required|string|max:255',
                'no_kontrak' => 'required|string|max:255',
                'nm_bujk' => 'required|string|max:255',	
                'penerapan_sistem_manajemen_mutu_konstruksi' => 'required|string',
                'pemenuhan_peralatan_pelaksanaan_proyek' => 'required|string',
                'penggunaan_material_standar' => 'required|string',
                'penggunaan_produk_dalam_negeri' => 'required|string',
                'pemenuhan_standar_mutu_material' => 'required|string',
                'pemenuhan_standar_teknis_lingkungan' => 'required|string',
                'pemenuhan_standar_k3' => 'required|string',
                'data_dukung' => 'nullable|file|mimes:pdf|max:5120', // Max 5MB
            ]);

            DB::beginTransaction(); // Mulai transaksi database

            // Cari data lama berdasarkan ID
            $item = K02::findOrFail($request->input('id'));

            // Jika ada file baru di-upload
            if ($request->hasFile('data_dukung')) {
                // Hapus file lama jika ada
                if ($item->data_dukung) {
                    $oldFilePath = public_path('uploads/data_dukung/' . $item->data_dukung);
                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath);
                    }
                }

                // Simpan file baru
                $file = $request->file('data_dukung');
                $namaFile = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/data_dukung'), $namaFile);

                $data['data_dukung'] = $namaFile;
            } else {
                // Kalau tidak upload file baru, jangan timpa file lama
                unset($data['data_dukung']);
            }

            // Update data ke database
            $item->update($data);

            DB::commit(); // Simpan transaksi

            // Redirect dengan pesan sukses
            return redirect()->back()->with('success', 'Data berhasil diperbarui');

        } catch (\Exception $e) {
            DB::rollBack(); // Gagal, rollback transaksi
            // Redirect dengan pesan error
            return redirect()->back()->with('error', 'Gagal memperbarui data.'. $e->getMessage());
        }
    } //DONE
    public function destroyk02($id)
    {
        try {
            $k02 = K02::findOrFail($id); // Mencari data berdasarkan ID

            // Cek apakah ada file yang terhubung dengan data ini
            if ($k02->data_dukung) {
                $filePath = public_path('uploads/data_dukung/' . $k02->data_dukung);
                
                // Jika file ada, hapus file tersebut
                if (file_exists($filePath)) {
                    unlink($filePath); // Menghapus file
                }
            }

            // Hapus data jika ditemukan
            $k02->delete();

            // Redirect dengan pesan sukses
            return redirect()->back()->with('admin.monev.k02.index')->with('success', 'Data berhasil dihapus!');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan
            return redirect()->back()->with('admin.monev.k02.index')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    } //DONE
   
    public function downloadk02($skpd_id)
    {
        // Ambil data K02 berdasarkan skpd_id
        $dataK02 = K02::where('skpd_id', $skpd_id)->get();

        // Load view untuk PDF
        $pdf = PDF::loadView('admin.monev.k02.pdf', compact('dataK02'));

        // Atur ukuran kertas ke A4 portrait
        $pdf->setPaper('A4', 'landscape');

        // Download langsung
        return $pdf->stream('k02_skpd_'.$skpd_id.'.pdf');
        // return $pdf->download('k02_skpd_'.$skpd_id.'.pdf');
    }

    public function k03()
    {
        // $data['urusan'] = $this->service->getDataUrusan();
        // $data['skpd'] = $this->service->getDataSkpd();

        // dd($data['data']);
        return view('admin.monev.k03.index');
    }

    public function k04()
    {
        // $data['urusan'] = $this->service->getDataUrusan();
        // $data['skpd'] = $this->service->getDataSkpd();

        // dd($data['data']);
        return view('admin.monev.k04.index');
    }
  
    // public function data(Request $request)
    // {
    //     if (auth()->user()->hasRole('admin')) {
    //    $a = trx_mr::with(['realisasi' => function ($query) {
    //         $query->orderBy('tgl_realisasi', 'desc');
    //     }])->with('skpd');
    //     if ($request->has('realisasi_filter')) {
    //         $filterValue = $request->realisasi_filter;
    //         switch ($filterValue) {
    //             case '>80':
    //                 $a->where(function ($query) {
    //                     $query->whereDoesntHave('realisasi', function ($query) {
    //                             $query->where('realisasi_fisik', '<=', 80);
    //                         }
    //                         )->orWhereHas('realisasi', function ($query) {
    //                             $query->where('realisasi_fisik', '>', 80)
    //                                 ->whereNotExists(function ($query) {
    //                             $query->select(DB::raw(1))
    //                                 ->from('trx_realisasi_monev as r2')
    //                                 ->whereRaw('r2.trx_monev_id = trx_realisasi_monev.trx_monev_id')
    //                                 ->where('r2.tgl_realisasi', '>', DB::raw('trx_realisasi_monev.tgl_realisasi'));
    //                         }
    //                         );
    //                     }
    //                     );
    //                 });
    //                 break;
    //             case '<80':
    //                 $a->where(function ($query) {
    //                     $query->whereDoesntHave('realisasi', function ($query) {
    //                             $query->where('realisasi_fisik', '>=', 80);
    //                         }
    //                         )->orWhereHas('realisasi', function ($query) {
    //                             $query->where('realisasi_fisik', '<', 80)
    //                                 ->whereNotExists(function ($query) {
    //                             $query->select(DB::raw(1))
    //                                 ->from('trx_realisasi_monev as r2')
    //                                 ->whereRaw('r2.trx_monev_id = trx_realisasi_monev.trx_monev_id')
    //                                 ->where('r2.tgl_realisasi', '>', DB::raw('trx_realisasi_monev.tgl_realisasi'));
    //                         }
    //                         );
    //                     }
    //                     );
    //                 });
    //                 break;
    //             case '<50':
    //                 $a->where(function ($query) {
    //                     $query->whereDoesntHave('realisasi', function ($query) {
    //                             $query->where('realisasi_fisik', '>=', 50);
    //                         }
    //                         )->orWhereHas('realisasi', function ($query) {
    //                             $query->where('realisasi_fisik', '<', 50)
    //                                 ->whereNotExists(function ($query) {
    //                             $query->select(DB::raw(1))
    //                                 ->from('trx_realisasi_monev as r2')
    //                                 ->whereRaw('r2.trx_monev_id = trx_realisasi_monev.trx_monev_id')
    //                                 ->where('r2.tgl_realisasi', '>', DB::raw('trx_realisasi_monev.tgl_realisasi'));
    //                         }
    //                         );
    //                     }
    //                     );
    //                 });
    //                 break;
    //         }        }
    //     $data = $a->get();
    //     }
    //     else {
    //          $a = trx_mr::where('skpd_id',auth()->user()->skpd_id)->with(['realisasi' => function ($query) {
    //         $query->orderBy('tgl_realisasi', 'desc');
    //     }])->with('skpd');
    //     if ($request->has('realisasi_filter')) {
    //         $filterValue = $request->realisasi_filter;
    //         switch ($filterValue) {
    //             case '>80':
    //                 $a->where(function ($query) {
    //                     $query->whereDoesntHave('realisasi', function ($query) {
    //                             $query->where('realisasi_fisik', '<=', 80);
    //                         }
    //                         )->orWhereHas('realisasi', function ($query) {
    //                             $query->where('realisasi_fisik', '>', 80)
    //                                 ->whereNotExists(function ($query) {
    //                             $query->select(DB::raw(1))
    //                                 ->from('trx_realisasi_monev as r2')
    //                                 ->whereRaw('r2.trx_monev_id = trx_realisasi_monev.trx_monev_id')
    //                                 ->where('r2.tgl_realisasi', '>', DB::raw('trx_realisasi_monev.tgl_realisasi'));
    //                         }
    //                         );
    //                     }
    //                     );
    //                 });
    //                 break;
    //             case '<80':
    //                 $a->where(function ($query) {
    //                     $query->whereDoesntHave('realisasi', function ($query) {
    //                             $query->where('realisasi_fisik', '>=', 80);
    //                         }
    //                         )->orWhereHas('realisasi', function ($query) {
    //                             $query->where('realisasi_fisik', '<', 80)
    //                                 ->whereNotExists(function ($query) {
    //                             $query->select(DB::raw(1))
    //                                 ->from('trx_realisasi_monev as r2')
    //                                 ->whereRaw('r2.trx_monev_id = trx_realisasi_monev.trx_monev_id')
    //                                 ->where('r2.tgl_realisasi', '>', DB::raw('trx_realisasi_monev.tgl_realisasi'));
    //                         }
    //                         );
    //                     }
    //                     );
    //                 });
    //                 break;
    //             case '<50':
    //                 $a->where(function ($query) {
    //                     $query->whereDoesntHave('realisasi', function ($query) {
    //                             $query->where('realisasi_fisik', '>=', 50);
    //                         }
    //                         )->orWhereHas('realisasi', function ($query) {
    //                             $query->where('realisasi_fisik', '<', 50)
    //                                 ->whereNotExists(function ($query) {
    //                             $query->select(DB::raw(1))
    //                                 ->from('trx_realisasi_monev as r2')
    //                                 ->whereRaw('r2.trx_monev_id = trx_realisasi_monev.trx_monev_id')
    //                                 ->where('r2.tgl_realisasi', '>', DB::raw('trx_realisasi_monev.tgl_realisasi'));
    //                         }
    //                         );
    //                     }
    //                     );
    //                 });
    //                 break;
    //         }        }
    //     $data = $a->get();
    //     }


    //     return DataTables::of($data)
    //         ->addIndexColumn()

    //         ->addColumn('button', function ($data) use ($request) {
    //         return '
    //                                        <div class="btn-group" role="group">
    //                                     <button id="btnGroupDrop1" type="button"
    //                                         class="btn btn-sm btn-outline-secondary dropdown-toggle"
    //                                         data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    //                                         <i class="menu-icon tf-icons bx bx-cog"></i>
    //                                     </button>
    //                                     <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
    //                                         <a href="'.route("admin.monev.add", [$data->id]).'" class="dropdown-item">
    //                                             <i class="bx bxs-add-to-queue"></i> Realisasi
    //                                         </a>
    //                                         <a href=" '.route("admin.monev.detail", [$data->id]).'" class="dropdown-item">
    //                                             <i class="bx bxs-low-vision"></i> Detail
    //                                         </a>
    //                                         <button class="dropdown-item" onclick="hapus('.$data->id.')">
    //                                             <i class="bx bxs-trash"></i> Hapus
    //                                         </button>
    //                                     </div>
    //                                 </div>
    //                                 ';
    //     })
    //     ->addColumn('tanggal', function ($data) {
    //         $time = strtotime($data->tgl_kontrak);
    //         $tanggalx = date('d-m-Y', $time);
    //         return $tanggalx;
    //     })
    //     ->addColumn('realisasi', function ($data) {

    //         return 'Rp ' . number_format($data->realisasi->realisasi, 0, ',', '.');
    //     })
    //         ->addColumn('realisasi_fisik', function ($data) {
    //         $today = date('d-m-Y');
    //         $time = strtotime($data->tgl_akhir);
    //         $tgl_akhir = date('d-m-Y', $time);
    //             $a = '<span class="badge badge-center rounded-pill bg-success">' . number_format($data->realisasi->realisasi_fisik, 0, ",", ".") . '</span>';
    //             if ($data->realisasi->realisasi_fisik < 50) {
    //             $a = '<span class="badge badge-center rounded-pill bg-danger">' . number_format($data->realisasi->realisasi_fisik, 0, ",", ".") . '</span>';
    //             } elseif($data->realisasi->realisasi_fisik < 80) {
    //             $a = '<span class="badge badge-center rounded-pill bg-warning">' . number_format($data->realisasi->realisasi_fisik, 0, ",", ".") . '</span>';
    //             }
    //             elseif ($data->realisasi->realisasi_fisik < 100 && $today > $tgl_akhir) {
    //                 $a = '<span class="badge badge-center rounded-pill bg-danger">' . number_format($data->realisasi->realisasi_fisik, 0, ",", ".") . '</span>';
    //             }
    //             elseif ($data->realisasi->realisasi_fisik == 100) {
    //             $a = '<span class="badge badge-center rounded-pill bg-primary">' . number_format($data->realisasi->realisasi_fisik, 0, ",", ".") . '</span>';
    //             }
    //             return $a;

    //     })
    //     ->addColumn('pagu', function ($data) {

    //         return 'Rp ' .number_format($data->pagu, 0, ',', '.');
    //     })
    //         ->addColumn('pagu_kontrak', function ($data) {

    //         return 'Rp ' .number_format($data->pagu_kontrak, 0, ',', '.');
    //     })
    //         ->rawColumns(['button','tanggal','realisasi','realisasi_fisik','pagu','pagu_kontrak', 'buttonnomen'])
    //         ->make(true);
    // }

    public function data(Request $request)

{
        if (auth()->user()->hasRole('admin')) {
            $a = trx_mr::with(['realisasi' => function ($query) {
                $query->orderBy('tgl_realisasi', 'desc');
            }])->with('skpd');
        }else{
            $a = trx_mr::with(['realisasi' => function ($query) {
                $query->orderBy('tgl_realisasi', 'desc');
            }])->where('skpd_id', auth()->user()->skpd_id)->with('skpd');
        }

        // Filter by SKPD
        if ($request->has('skpd_id')) {
            if ($request->skpd_id != '') {
                $a->where('skpd_id', $request->skpd_id);
            }
        }

        // Filter by realisasi
        if ($request->has('realisasi_filter')) {
            $filterValue = $request->realisasi_filter;
            switch ($filterValue) {
                case '>80':
                    $a->where(function ($query) {
                        $query->whereDoesntHave('realisasi', function ($query) {
                                $query->where('realisasi_fisik', '<=', 80);
                            }
                            )->orWhereHas('realisasi', function ($query) {
                                $query->where('realisasi_fisik', '>', 80)
                                    ->whereNotExists(function ($query) {
                                $query->select(DB::raw(1))
                                    ->from('trx_realisasi_monev as r2')
                                    ->whereRaw('r2.trx_monev_id = trx_realisasi_monev.trx_monev_id')
                                    ->where('r2.tgl_realisasi', '>', DB::raw('trx_realisasi_monev.tgl_realisasi'));
                            }
                            );
                        }
                        );
                    });
                    break;
                case '<80':
                    $a->where(function ($query) {
                        $query->whereDoesntHave('realisasi', function ($query) {
                                $query->where('realisasi_fisik', '>=', 80);
                            }
                            )->orWhereHas('realisasi', function ($query) {
                                $query->where('realisasi_fisik', '<', 80)
                                    ->whereNotExists(function ($query) {
                                $query->select(DB::raw(1))
                                    ->from('trx_realisasi_monev as r2')
                                    ->whereRaw('r2.trx_monev_id = trx_realisasi_monev.trx_monev_id')
                                    ->where('r2.tgl_realisasi', '>', DB::raw('trx_realisasi_monev.tgl_realisasi'));
                            }
                            );
                        }
                        );
                    });
                    break;
                case '<50':
                    $a->where(function ($query) {
                        $query->whereDoesntHave('realisasi', function ($query) {
                                $query->where('realisasi_fisik', '>=', 50);
                            }
                            )->orWhereHas('realisasi', function ($query) {
                                $query->where('realisasi_fisik', '<', 50)
                                    ->whereNotExists(function ($query) {
                                $query->select(DB::raw(1))
                                    ->from('trx_realisasi_monev as r2')
                                    ->whereRaw('r2.trx_monev_id = trx_realisasi_monev.trx_monev_id')
                                    ->where('r2.tgl_realisasi', '>', DB::raw('trx_realisasi_monev.tgl_realisasi'));
                            }
                            );
                        }
                        );
                    });
                    break;
            }
        }

        $data = $a->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('button', function ($data) use ($request) {
            return '
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button"
                        class="btn btn-sm btn-outline-secondary dropdown-toggle"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="menu-icon tf-icons bx bx-cog"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                        <a href="' . route("admin.monev.add", [$data->id]) . '" class="dropdown-item">
                            <i class="bx bxs-add-to-queue"></i> Realisasi
                        </a>
                        <a href=" ' . route("admin.monev.detail", [$data->id]) . '" class="dropdown-item">
                            <i class="bx bxs-low-vision"></i> Detail
                        </a>
                        <button class="dropdown-item" onclick="hapus(' . $data->id . ')">
                            <i class="bx bxs-trash"></i> Hapus
                        </button>
                    </div>
                </div>
            ';
        })
            ->addColumn('tanggal', function ($data) {
            $time = strtotime($data->tgl_kontrak);
            $tanggalx = date('d-m-Y', $time);
            return $tanggalx;
        })
            ->addColumn('realisasi', function ($data) {
                if (isset($data->realisasi)) {
                return 'Rp ' . number_format($data->realisasi->realisasi, 0, ',', '.');
                } else {
                return '-';
                }


        })
            ->addColumn('realisasi_fisik', function ($data) {

            if (isset($data->realisasi)) {
                $today = date('d-m-Y');
                $time = strtotime($data->tgl_akhir);
                $tgl_akhir = date('d-m-Y', $time);
                $a = '<span class="badge badge-center rounded-pill bg-success">' . number_format($data->realisasi->realisasi_fisik, 0, ",", ".") . '</span>';
                if ($data->realisasi->realisasi_fisik < 50) {
                    $a = '<span class="badge badge-center rounded-pill bg-danger">' . number_format($data->realisasi->realisasi_fisik, 0, ",", ".") . '</span>';
                }
                elseif ($data->realisasi->realisasi_fisik < 80) {
                    $a = '<span class="badge badge-center rounded-pill bg-warning">' . number_format($data->realisasi->realisasi_fisik, 0, ",", ".") . '</span>';
                }
                elseif ($data->realisasi->realisasi_fisik < 100 && $today > $tgl_akhir) {
                    $a = '<span class="badge badge-center rounded-pill bg-danger">' . number_format($data->realisasi->realisasi_fisik, 0, ",", ".") . '</span>';
                }
                elseif ($data->realisasi->realisasi_fisik == 100) {
                    $a = '<span class="badge badge-center rounded-pill bg-primary">' . number_format($data->realisasi->realisasi_fisik, 0, ",", ".") . '</span>';
                }
                return $a;
            }
            else {
                return '-';
            }

        })
            ->addColumn('pagu', function ($data) {
            return 'Rp ' . number_format($data->pagu, 0, ',', '.');
        })
            ->addColumn('pagu_kontrak', function ($data) {
            return 'Rp ' . number_format($data->pagu_kontrak, 0, ',', '.');
        })
            ->rawColumns(['button', 'tanggal', 'realisasi', 'realisasi_fisik', 'pagu', 'pagu_kontrak', 'buttonnomen'])
            ->make(true);
         }


      public function storefile(Request $request)
    {

        $validator = Validator::make(request()->all(), [
            'file.*' => 'nullable|file|max:2048',
        ],
        [
            'file.*.max' => 'Ukuran file tidak boleh melebihi 2MB.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => "failed",
                "message" => "Maksimal file 2 MB",
            ]);
        }
        else {
            foreach ($request->file('file') as $i => $file) {
                trx_upload::create([
                    'skpd_id' => $request->input('skpd_id'),
                    'trx_monev_id' => $request->input('trx_monev_id'),
                    'ket' => $request->input('ket'),
                    'tahun' => $request->input('tahun'),
                    // 'original_name' => $file->getClientOriginalName(),
                    'file' => $file->store('file', 'public'),
                ]);
            }
            return response()->json([
                "status" => "success",
                "messages" => "Berhasil Menambahkan Data",
            ]);
        }
    }

}
