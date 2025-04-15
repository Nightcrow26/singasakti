<?php

namespace App\Http\Controllers;

use App\Models\Skpd;
use App\Models\Tahun;
use App\Models\trx_mr;
use App\Models\MasterUpload;
use Illuminate\Http\Request;
use App\Services\MonevService;
use App\Services\MasterService;
use App\Models\tbl_master_kunci;
use App\Models\trx_upload_berkas;
use Illuminate\Support\Facades\Validator;

class PengawasanController extends Controller
{
    //
    public function __construct()
    {
        $this->service = new MasterService;
        $this->monev = new MonevService;
    }

    // public function index()
    // {
    //     if (auth()->user()->hasRole('admin')) {
    //         $data['data'] = trx_mr::with(['realisasis' => function ($query) {
    //             $query->orderBy('tgl_realisasi', 'desc');
    //         }])->with('skpd')->where('tahun', auth()->user()->tahun)->get();
    //     }
    //     else {
    //         $data['data'] = trx_mr::where('skpd_id', auth()->user()->skpd_id)->with(['realisasis' => function ($query) {
    //             $query->orderBy('tgl_realisasi', 'desc');
    //         }])->with('skpd')->where('tahun', auth()->user()->tahun)->get();
    //     }

    //     if (auth()->user()->hasRole('admin')) {
    //         $data['monev'] = trx_mr::with(['realisasis' => function ($query) {
    //             $query->orderBy('tgl_realisasi', 'desc');
    //         }])->with('skpd')->where('tahun', auth()->user()->tahun)->get();
    //     }
    //     else {
    //         $data['monev'] = trx_mr::where('skpd_id', auth()->user()->skpd_id)->with(['realisasis' => function ($query) {
    //             $query->orderBy('tgl_realisasi', 'desc');
    //         }])->with('skpd')->where('tahun', auth()->user()->tahun)->get();
    //     }

    //     $data['kunci'] = Tahun::where('tahun', auth()->user()->tahun)->first();
    //     $data['urusan'] = $this->service->getDataUrusan();
    //     $data['skpd'] = $this->service->getDataSkpd();
    //     $data['skpd2'] = $this->service->getDataSkpd();
    //     $data['upload'] = MasterUpload::get();

    //     return view('admin.monev.pengawasan.index', $data);
    // }

    public function index(Request $request)

{
        $selectedSkpdId = $request->input('skpd_id');

        if (auth()->user()->hasRole('admin')) {
            $query = trx_mr::with(['realisasis' => function ($query) {
                $query->orderBy('tgl_realisasi', 'desc');
            }])->with('skpd');

            if ($selectedSkpdId) {
                $query->where('skpd_id', $selectedSkpdId);
            }

            $data['data'] = $query->get();
            $data['monev'] = $query->get();
        }
        else {
            // dd(auth()->user()->skpd_id);
            $query = trx_mr::where('skpd_id', auth()->user()->skpd_id)->with(['realisasis' => function ($query) {
                $query->orderBy('tgl_realisasi', 'desc');
            }])->with('skpd');

            if ($selectedSkpdId) {
                $query->where('skpd_id', $selectedSkpdId);
            }

            $data['data'] = $query->get();
            $data['monev'] = $query->get();
        }

        $data['kunci'] = Tahun::where('tahun', auth()->user()->tahun)->first();
        $data['urusan'] = $this->service->getDataUrusan();
        $data['skpd'] = Skpd::all(); // Mengambil semua data SKPD
        $data['skpd2'] = Skpd::all(); // Mengambil semua data SKPD
        $data['upload'] = MasterUpload::get();
        $data['selectedSkpdId'] = $selectedSkpdId; // Menyimpan SKPD yang dipilih

        return view('admin.monev.pengawasan.index', $data);
    }

    public function storefile(Request $request)
    {

        $validator = Validator::make(request()->all(), [
            'file' => 'nullable|file|max:2048|mimes:pdf', ],
        [
            'file.max' => 'Ukuran file tidak boleh melebihi 2MB.',
            'file.mimes' => 'File yang diunggah harus berformat PDF.',
        ]);


        if ($validator->fails()) {
            return response()->json([
                "status" => "failed",
                "message" => $validator->errors()->first(),
            ]);
        }
        else {
            if ($request->input('berkas') == 1):
                foreach ($request->input('trx_monev_id') as $i => $a) {
                    trx_upload_berkas::where('trx_monev_id', $a)->update([
                        'skpd_id' => $request->input('skpd_id'),
                        'trx_monev_id' => $a,
                        'tahun' => $request->input('tahun'),
                        'up_1' => $request->file('file')->store('file', 'public'),
                    ]);
                }
            elseif ($request->input('berkas') == 2):
                foreach ($request->input('trx_monev_id') as $i => $a) {
                    trx_upload_berkas::where('trx_monev_id', $a)->update([
                        'skpd_id' => $request->input('skpd_id'),
                        'trx_monev_id' => $a,
                        'tahun' => $request->input('tahun'),
                        'up_2' => $request->file('file')->store('file', 'public'),
                    ]);
                }
            elseif ($request->input('berkas') == 3):
                foreach ($request->input('trx_monev_id') as $i => $a) {
                    trx_upload_berkas::where('trx_monev_id', $a)->update([
                        'skpd_id' => $request->input('skpd_id'),
                        'trx_monev_id' => $a,
                        'tahun' => $request->input('tahun'),
                        'up_3' => $request->file('file')->store('file', 'public'),
                    ]);
                }
            elseif ($request->input('berkas') == 4):
                foreach ($request->input('trx_monev_id') as $i => $a) {
                    trx_upload_berkas::where('trx_monev_id', $a)->update([
                        'skpd_id' => $request->input('skpd_id'),
                        'trx_monev_id' => $a,
                        'tahun' => $request->input('tahun'),
                        'up_4' => $request->file('file')->store('file', 'public'),
                    ]);
                }
            elseif ($request->input('berkas') == 5):
                foreach ($request->input('trx_monev_id') as $i => $a) {
                    trx_upload_berkas::where('trx_monev_id', $a)->update([
                        'skpd_id' => $request->input('skpd_id'),
                        'trx_monev_id' => $a,
                        'tahun' => $request->input('tahun'),
                        'up_5' => $request->file('file')->store('file', 'public'),
                    ]);
                }
            elseif ($request->input('berkas') == 6):
                foreach ($request->input('trx_monev_id') as $i => $a) {
                    trx_upload_berkas::where('trx_monev_id', $a)->update([
                        'skpd_id' => $request->input('skpd_id'),
                        'trx_monev_id' => $a,
                        'tahun' => $request->input('tahun'),
                        'up_6' => $request->file('file')->store('file', 'public'),
                    ]);
                }
            elseif ($request->input('berkas') == 7):
                foreach ($request->input('trx_monev_id') as $i => $a) {
                    trx_upload_berkas::where('trx_monev_id', $a)->update([
                        'skpd_id' => $request->input('skpd_id'),
                        'trx_monev_id' => $a,
                        'tahun' => $request->input('tahun'),
                        'up_7' => $request->file('file')->store('file', 'public'),
                    ]);
                }
            elseif ($request->input('berkas') == 8):
                foreach ($request->input('trx_monev_id') as $i => $a) {
                    trx_upload_berkas::where('trx_monev_id', $a)->update([
                        'skpd_id' => $request->input('skpd_id'),
                        'trx_monev_id' => $a,
                        'tahun' => $request->input('tahun'),
                        'up_8' => $request->file('file')->store('file', 'public'),
                    ]);
                }
            elseif ($request->input('berkas') == 9):
                foreach ($request->input('trx_monev_id') as $i => $a) {
                    trx_upload_berkas::where('trx_monev_id', $a)->update([
                        'skpd_id' => $request->input('skpd_id'),
                        'trx_monev_id' => $a,
                        'tahun' => $request->input('tahun'),
                        'up_9' => $request->file('file')->store('file', 'public'),
                    ]);
                }
            endif;

            return response()->json([
                "status" => "success",
                "messages" => "Berhasil Menambahkan Data",
            ]);
        }
    }

    public function showfile(Request $request)
    {
        $trx = trx_upload_berkas::where('id', $request->input('id'))->first();
        if ($request->input('berkas') == 1):
            $file = $trx->up_1;
        elseif ($request->input('berkas') == 2):
            $file = $trx->up_2;
        elseif ($request->input('berkas') == 3):
            $file = $trx->up_3;
        elseif ($request->input('berkas') == 4):
            $file = $trx->up_4;
        elseif ($request->input('berkas') == 5):
            $file = $trx->up_5;
        elseif ($request->input('berkas') == 6):
            $file = $trx->up_6;
        elseif ($request->input('berkas') == 7):
            $file = $trx->up_7;
        elseif ($request->input('berkas') == 8):
            $file = $trx->up_8;
        elseif ($request->input('berkas') == 9):
            $file = $trx->up_9;
        endif;
        return response()->json([
            'id' => $trx->id,
            'file' => $file,
        ]);
    }

    public function delete(Request $request)
    {
        trx_upload_berkas::where('id', $request->input('id'))->delete();

        return response()->json(true);
    }
}
