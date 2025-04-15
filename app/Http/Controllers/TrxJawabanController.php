<?php

namespace App\Http\Controllers;

use App\Models\Indikator;
use App\Models\Skpd;
use App\Models\TrxJawaban;
use App\Models\TrxUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\TrxJawabanService;

class TrxJawabanController extends Controller
{
    //
    public function __construct()
    {
        $this->service = new TrxJawabanService;
    }

    public function indexspbe()
    {
        $data['data'] = $this->service->getDataIndikatorskpd();
        return view('skpd.spbe.index', $data);
    }


    public function addspbe(Request $request)
    {
        $data['data'] = Indikator::with('jawabans')->with('domainname')->with('aspekname')->where('id', $request->input('id'))->get();
        // dd($data['data']);
        return view('skpd.spbe.add', $data);
    }

    public function detailspbe(Request $request)
    {
        $data['data'] = Indikator::with('jawabans')->with('trxuploads')->where('id', $request->input('id'))->get();
        $data['keterangan'] = TrxJawaban::where('id', $request->input('trx_id'))->get();
        // dd($data['data']);
        return view('skpd.spbe.detail', $data);
    }

    public function deletespbe(Request $request)
    {
        TrxJawaban::where('indikator_id', $request->input('indikator_id'))->where('user_id', auth()->user()->id)->where('skpd_id', auth()->user()->skpd_id)->delete();
        TrxUpload::where('indikator_id', $request->input('indikator_id'))->where('user_id', auth()->user()->id)->where('skpd_id', auth()->user()->skpd_id)->delete();
        return response()->json([
            "status" => "success",
            "messages" => "Berhasil Menambahkan Data",
        ]);
    }

    public function deleteupload(Request $request)
    {
        TrxUpload::where('id', $request->input('id'))->delete();
        return response()->json([
            "status" => "success",
            "messages" => "Berhasil Menambahkan Data",
        ]);
    }

    public function storespbe(Request $request)
    {
        // dd($request->all());

        $file = [
            'nama_file.*' => 'max:5048|mimes:pdf,jpg,jpeg,png',
        ];
        $file_val = validator()->make(request()->all(), $file);

        if ($file_val->fails()) {
            return response()->json('file');
        }

        DB::transaction(function () use ($request) {
            $jawaban = DB::table('trx_jawaban')->insertGetId([
                'user_id' => auth()->user()->id,
                'skpd_id' => auth()->user()->skpd_id,
                'indikator_id' =>  $request->input('indikator_id'),
                'domain_id' =>  $request->input('domain_id'),
                'aspek_id' =>  $request->input('aspek_id'),
                'jawaban_skpd_id' =>  $request->input('jawaban_skpd_id'),
                'keterangan' =>  $request->input('keterangan'),
                "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
            ]);
            if ($request->hasFile('file')) {
                foreach ($request->file('file') as $i => $file) {
                    $lapmiran = DB::table('trx_upload')->insertGetId([
                        'user_id' => auth()->user()->id,
                        'skpd_id' => auth()->user()->skpd_id,
                        'indikator_id' =>  $request->input('indikator_id'),
                        'file' => $file->store('file', 'public'),
                        'original_name' => $file->getClientOriginalName(),
                        "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                        "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
                    ]);
                }
            }
        });
        return response()->json([
            "status" => "success",
            "messages" => "Berhasil Menambahkan Data",
        ]);
    }

    public function updatespbeskpd(Request $request)
    {
        // dd($request->all());

        $file = [
            'nama_file.*' => 'max:5048|mimes:pdf,jpg,jpeg,png',
        ];
        $file_val = validator()->make(request()->all(), $file);

        if ($file_val->fails()) {
            return response()->json('file');
        }

        DB::transaction(function () use ($request) {

            $will_insert = $request->except(['file', '_token', '_method']);
            // dd($will_insert);
            $TrxJawaban = TrxJawaban::where('indikator_id', $request->input('indikator_id'))->where('user_id', auth()->user()->id)->where('skpd_id', auth()->user()->skpd_id)->update($will_insert);
            if ($request->hasFile('file')) {
                foreach ($request->file('file') as $i => $file) {
                    $lapmiran = DB::table('trx_upload')->insertGetId([
                        'user_id' => auth()->user()->id,
                        'skpd_id' => auth()->user()->skpd_id,
                        'indikator_id' =>  $request->input('indikator_id'),
                        'file' => $file->store('file', 'public'),
                        'original_name' => $file->getClientOriginalName(),
                        "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                        "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
                    ]);
                }
            }
        });
        return response()->json([
            "status" => "success",
            "messages" => "Berhasil Menambahkan Data",
        ]);
    }

    public function updatespbe(Request $request)
    {
        $will_insert = $request->except(['_token', '_method']);


        $TrxJawaban = TrxJawaban::where('id', $request->input('id'))->update($will_insert);

        return response()->json([
            "status" => "success",
            "messages" => "Berhasil Menambahkan Data",
        ]);
    }


    public function indexspbeadmin()
    {
        // $data['data'] = Skpd::where('jenis', 'skpd')->get();
        // $data['count'] = Indikator::count();
        // $data['countskpd'] = Skpd::where('jenis', 'skpd')->count();
        $data['data'] = $this->service->getDataIndikator();
        return view('admin.spbe.index', $data);
    }

    public function indexdetailspbeadmin($id)
    {
        $data['skpd_id'] = $id;
        $data['data'] = $this->service->getDataIndikator();
        return view('admin.spbe.detail', $data);
    }

    public function showspbe(Request $request)
    {
        $data['data'] = Indikator::with('jawabans')->with('trxuploads')->where('id', $request->input('id'))->get();
        $data['keterangan'] = TrxJawaban::where('id', $request->input('trx_id'))->get();
        $data['skpd_id'] = $request->input('skpd_id');
        // dd($data['data']);
        return view('admin.spbe.show', $data);
    }

    public function verifspbe(Request $request)
    {
        $data['data'] = Indikator::with('jawabans')->where('id', $request->input('id'))->get();
        $data['trx'] = TrxJawaban::where('id', $request->input('trx_id'))->get();
        $data['catatan'] = TrxJawaban::where('id', $request->input('trx_id'))->get();
        $data['skpd_id'] = $request->input('skpd_id');
        $data['trx_id'] = $request->input('trx_id');
        // dd($data['data']);
        return view('admin.spbe.verif', $data);
    }

    public function verifspbeskpdadmin(Request $request)
    {
        $data['data'] = Indikator::with('jawabans')->where('id', $request->input('id'))->get();
        $data['trx'] = TrxJawaban::where('id', $request->input('trx_id'))->get();
        $data['catatan'] = TrxJawaban::where('id', $request->input('trx_id'))->get();
        $data['skpd_id'] = $request->input('skpd_id');
        // dd($data['data']);
        return view('admin.spbe.verifskpd', $data);
    }

    public function verifspbeskpd(Request $request)
    {
        $data['data'] = Indikator::with('jawabans')->where('id', $request->input('id'))->get();
        $data['trx'] = TrxJawaban::where('id', $request->input('trx_id'))->get();
        $data['catatan'] = TrxJawaban::where('id', $request->input('trx_id'))->get();
        // dd($data['data']);
        return view('skpd.spbe.verif', $data);
    }
}
