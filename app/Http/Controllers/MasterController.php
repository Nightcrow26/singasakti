<?php

namespace App\Http\Controllers;

use App\Models\Skpd;
use App\Models\Aspek;
use App\Models\Domain;
use App\Models\Urusan;
use App\Models\Program;
use App\Models\Kegiatan;
use App\Models\Indikator;
use App\Models\Nomenklatur;
use App\Models\SubKegiatan;
use App\Models\trx_program;
use App\Models\BidangUrusan;
use App\Models\trx_kegiatan;
use Illuminate\Http\Request;
use App\Services\MasterService;
use App\Models\trx_bidang_urusan;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class MasterController extends Controller
{
    public function __construct()
    {
        $this->service = new MasterService;
    }

    public function indexskpd()
    {
        return view('admin.master.skpd.index');
    }

    public function indexuser()
    {
        $data['skpd'] = $this->service->getDataSkpd();
        return view('admin.master.user.index', $data);
    }

    public function indexurusan()
    {
        return view('admin.master.urusan.index');
    }

    public function indexbidang()
    {
        return view('admin.master.bidang.index');
    }

    public function indexprogram()
    {
        return view('admin.master.program.index');
    }

    public function indexkegiatan()
    {
        return view('admin.master.kegiatan.index');
    }

    public function indexsub()
    {
        return view('admin.master.sub.index');
    }

    public function indexnomen()
    {
        $data['urusan'] = $this->service->getDataUrusan();
        return view('admin.master.nomen.index', $data);
    }

    public function data(Request $request)
    {
        switch ($request->type) {
            case 'skpd':
                $data = $this->service->getDataSkpd();
                break;
            case 'urusan':
                $data = $this->service->getDataUrusan();
                break;
            case 'bidang':
                $data = $this->service->getDataBidang();
                break;
            case 'program':
                $data = $this->service->getDataProgram();
                break;
            case 'kegiatan':
                $data = $this->service->getDataKegiatan();
                break;
            case 'sub':
                $data = $this->service->getDataSub();
                break;
            case 'nomen':
                $data = $this->service->getDataNomen();
                break;
            case 'user':
                $data = $this->service->getDataUser();
                break;
            default:
                $data = collect();
                break;
        }

        return DataTables::of($data)
            ->addIndexColumn()

            ->addColumn('button', function ($data) use ($request) {
            return '
                                        <button onclick="edit(' . $data->id . ')"  data-bs-toggle="modal" data-bs-target="#modal-edit" class="btn btn-sm btn-flat btn-primary my-2"><i class="bx bx-edit-alt"></i></button>
                                        <button onclick="deletebtn(' . $data->id . ')" class="btn btn-sm btn-flat btn-danger my-2"><i class="bx bx-trash" ></i></button>
                                    ';
        })
            ->addColumn('buttonnomen', function ($data) use ($request) {
            return '
                                        <button onclick="deletebtn(' . $data->id . ')" class="btn btn-sm btn-flat btn-danger my-2"><i class="bx bx-trash" ></i></button>
                                    ';
        })
            ->rawColumns(['button', 'buttonnomen'])
            ->make(true);
    }

    public function showdata(Request $request)
    {
        $id = $request->id;
        switch ($request->type) {
            case 'skpd':
                $data = $this->service->getDataSkpd($id);
                break;
            case 'urusan':
                $data = $this->service->getDataUrusan($id);
                break;
            case 'bidang':
                $data = $this->service->getDataBidang($id);
                break;
            case 'program':
                $data = $this->service->getDataProgram($id);
                break;
            case 'kegiatan':
                $data = $this->service->getDataKegiatan($id);
                break;
            case 'sub':
                $data = $this->service->getDataSub($id);
                break;
            case 'nomen':
                $data = $this->service->getDataNomen($id);
                break;
            case 'user':
                $data = $this->service->getDataUser($id);
                break;
            default:
                $data = collect();
                break;
        }
        if ($request->type == 'skpd') {
            return response()->json(
            [
                'id' => $data->id,
                'nama' => $data->nama,
                'singkatan' => $data->singkatan,
            ]
            );
        }
        elseif ($request->type == 'urusan' or $request->type == 'bidang' or $request->type == 'program' or $request->type == 'kegiatan' or $request->type == 'sub') {
            return response()->json(
            [
                'id' => $data->id,
                'nama' => $data->nama,
                'slug' => $data->slug,
            ]
            );
        }
        elseif ($request->type == 'user') {
            $dataSkpd = $this->service->getDataSkpd($data->skpd_id);
            $dataSkpdAll = $this->service->getDataSkpd();
            return response()->json(
            [
                'id' => $data->id,
                'name' => $data->name,
                'skpd_id' => $data->skpd_id,
                'skpd' => $dataSkpd,
                'skpdall' => $dataSkpdAll,
            ]
            );
        }
    }

    public function deletedata(Request $request)
    {
        $id = $request->id;
        switch ($request->type) {
            case 'skpd':
                $data = $this->service->deleteDataSkpd($id);
                break;
            case 'urusan':
                $data = $this->service->deleteDataUrusan($id);
                break;
            case 'bidang':
                $data = $this->service->deleteDataBidang($id);
                break;
            case 'program':
                $data = $this->service->deleteDataProgram($id);
                break;
            case 'kegiatan':
                $data = $this->service->deleteDataKegiatan($id);
                break;
            case 'sub':
                $data = $this->service->deleteDataSub($id);
                break;
            case 'nomen':
                $data = $this->service->deleteDataNomen($id);
                break;
            case 'user':
                $data = $this->service->deleteDataMasterUser($id);
                break;
            default:
                $data = collect();
                break;
        }
        if ($data == true) {
            return response()->json([
                "status" => "success",
                "messages" => "Berhasil Menghapus Data",
            ]);
        }
        else {
            return response()->json([
                "status" => "failed",
                "messages" => "Gagal Menghapus Data",
            ]);
        }
    }

    public function storeskpd(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'nama' => 'required|unique:tbl_master_skpd,nama',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => "failed",
                "message" => $validator->errors()->first(),
            ]);
        }
        else {
            $store = $this->service->storeSkpd($request->all());
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


    public function updateskpd(Request $request)
    {
        $id = $request->id;
        $validator = Validator::make(request()->all(), [
            'nama' => 'required|unique:tbl_master_skpd,nama,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => "failed",
                "message" => $validator->errors()->first(),
            ]);
        }
        else {
            $store = $this->service->updateSkpd($id, $request->all());
            if ($store == true) {
                return response()->json([
                    "status" => "success",
                    "messages" => "Berhasil memperbaharui Data",
                ]);
            }
            else {
                return response()->json([
                    "status" => "failed",
                    "messages" => "Gagal memperbaharui Data",
                ]);
            }
        }
    }

    public function storeuser(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required|unique:users,name',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => "failed",
                "message" => $validator->errors()->first(),
            ]);
        }
        else {
            $store = $this->service->storeMasterUser($request->all());
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


    public function updateuser(Request $request)
    {
        $id = $request->id;
        $validator = Validator::make(request()->all(), [
            'name' => 'required|unique:users,name,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => "failed",
                "message" => $validator->errors()->first(),
            ]);
        }
        else {
            $store = $this->service->updateMasterUser($id, $request->all());
            if ($store == true) {
                return response()->json([
                    "status" => "success",
                    "messages" => "Berhasil memperbaharui Data",
                ]);
            }
            else {
                return response()->json([
                    "status" => "failed",
                    "messages" => "Gagal memperbaharui Data",
                ]);
            }
        }
    }


    public function storeurusan(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'nama' => 'required|unique:ref_urusan,nama',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => "failed",
                "message" => $validator->errors()->first(),
            ]);
        }
        else {
            $store = $this->service->storeUrusan($request);
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


    public function updateurusan(Request $request)
    {
        $id = $request->id;
        $validator = Validator::make(request()->all(), [
            'nama' => 'required|unique:ref_urusan,nama,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => "failed",
                "message" => $validator->errors()->first(),
            ]);
        }
        else {
            $store = $this->service->updateUrusan($request);
            if ($store == true) {
                return response()->json([
                    "status" => "success",
                    "messages" => "Berhasil memperbaharui Data",
                ]);
            }
            else {
                return response()->json([
                    "status" => "failed",
                    "messages" => "Gagal memperbaharui Data",
                ]);
            }
        }
    }

    public function storebidang(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'nama' => 'required|unique:ref_bidang_urusan,nama',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => "failed",
                "message" => $validator->errors()->first(),
            ]);
        }
        else {
            $store = $this->service->storeBidang($request);
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


    public function updatebidang(Request $request)
    {
        $id = $request->id;
        $validator = Validator::make(request()->all(), [
            'nama' => 'required|unique:ref_bidang_urusan,nama,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => "failed",
                "message" => $validator->errors()->first(),
            ]);
        }
        else {
            $store = $this->service->updateBidang($request);
            if ($store == true) {
                return response()->json([
                    "status" => "success",
                    "messages" => "Berhasil memperbaharui Data",
                ]);
            }
            else {
                return response()->json([
                    "status" => "failed",
                    "messages" => "Gagal memperbaharui Data",
                ]);
            }
        }
    }

    public function storeprogram(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'nama' => 'required|unique:ref_program,nama',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => "failed",
                "message" => $validator->errors()->first(),
            ]);
        }
        else {
            $store = $this->service->storeProgram($request);
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


    public function updateprogram(Request $request)
    {
        $id = $request->id;
        $validator = Validator::make(request()->all(), [
            'nama' => 'required|unique:ref_program,nama,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => "failed",
                "message" => $validator->errors()->first(),
            ]);
        }
        else {
            $store = $this->service->updateProgram($request);
            if ($store == true) {
                return response()->json([
                    "status" => "success",
                    "messages" => "Berhasil memperbaharui Data",
                ]);
            }
            else {
                return response()->json([
                    "status" => "failed",
                    "messages" => "Gagal memperbaharui Data",
                ]);
            }
        }
    }

    public function storekegiatan(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'nama' => 'required|unique:ref_kegiatan,nama',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => "failed",
                "message" => $validator->errors()->first(),
            ]);
        }
        else {
            $store = $this->service->storeKegiatan($request);
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


    public function updatekegiatan(Request $request)
    {
        $id = $request->id;
        $validator = Validator::make(request()->all(), [
            'nama' => 'required|unique:ref_kegiatan,nama,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => "failed",
                "message" => $validator->errors()->first(),
            ]);
        }
        else {
            $store = $this->service->updateKegiatan($request);
            if ($store == true) {
                return response()->json([
                    "status" => "success",
                    "messages" => "Berhasil memperbaharui Data",
                ]);
            }
            else {
                return response()->json([
                    "status" => "failed",
                    "messages" => "Gagal memperbaharui Data",
                ]);
            }
        }
    }

    public function storesub(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'nama' => 'required|unique:ref_sub_kegiatan,nama',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => "failed",
                "message" => $validator->errors()->first(),
            ]);
        }
        else {
            $store = $this->service->storeSub($request);
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


    public function updatesub(Request $request)
    {
        $id = $request->id;
        $validator = Validator::make(request()->all(), [
            'nama' => 'required|unique:ref_sub_kegiatan,nama,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => "failed",
                "message" => $validator->errors()->first(),
            ]);
        }
        else {
            $store = $this->service->updateSub($request);
            if ($store == true) {
                return response()->json([
                    "status" => "success",
                    "messages" => "Berhasil memperbaharui Data",
                ]);
            }
            else {
                return response()->json([
                    "status" => "failed",
                    "messages" => "Gagal memperbaharui Data",
                ]);
            }
        }
    }

    public function storenomen(Request $request)
    {
        $validator = Nomenklatur::where('ref_urusan', $request->input('ref_urusan'))->where('ref_bidang_urusan', $request->input('ref_bidang_urusan'))->where('ref_program', $request->input('ref_program'))->where('ref_kegiatan', $request->input('ref_kegiatan'))->where('ref_sub_kegiatan', $request->input('ref_sub_kegiatan'))->where('jenis', $request->input('jenis'))->first();

        if (isset($validator)) {
            return response()->json([
                "status" => "failed",
                "message" => 'Nomenklatur Sudah Ada',
            ]);
        }
        else {
            $store = $this->service->storeNomen($request);
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


    public function updatenomen(Request $request)
    {
        $id = $request->id;
        $validator = Validator::make(request()->all(), [
            // 'nama' => 'required|unique:ref_nomen_kegiatan,nama,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => "failed",
                "message" => $validator->errors()->first(),
            ]);
        }
        else {
            $store = $this->service->updateNomen($request);
            if ($store == true) {
                return response()->json([
                    "status" => "success",
                    "messages" => "Berhasil memperbaharui Data",
                ]);
            }
            else {
                return response()->json([
                    "status" => "failed",
                    "messages" => "Gagal memperbaharui Data",
                ]);
            }
        }
    }




    public function bidang(Request $request)
    {
        $nom = Nomenklatur::where('ref_urusan', $request->input('id'))->groupBy('ref_bidang_urusan')->pluck('ref_bidang_urusan');

        $bidang_urusan = BidangUrusan::select();

        // foreach ($nom as $a => $value) {
        //     $bidang_urusan = $bidang_urusan->OrWhere('id', $value);
        // }
        $bidang_urusan = $bidang_urusan->pluck('nama', 'id');



        // dd($bidang_urusan);

        return response()->json($bidang_urusan);
    }




    public function program(Request $request)
    {
        $nom = Nomenklatur::where('ref_urusan', $request->input('ref_urusan'))->where('ref_bidang_urusan', $request->input('ref_bidang_urusan'))->groupBy('ref_program')->pluck('ref_program');

        $program = Program::select();

        // foreach ($nom as $a => $value) {
        //     $program = $program->OrWhere('id', $value);
        // }
        $program = $program->pluck('nama', 'id');



        // dd($bidang_urusan);

        return response()->json($program);
    }

    public function kegiatan(Request $request)
    {
        $nom = Nomenklatur::where('ref_urusan', $request->input('ref_urusan'))->where('ref_bidang_urusan', $request->input('ref_bidang_urusan'))->where('ref_program', $request->input('ref_program'))->groupBy('ref_kegiatan')->pluck('ref_kegiatan');

        // $nom = Nomenklatur::where('ref_urusan', 1)->where('ref_bidang_urusan', 1)->where('ref_program', 159)->groupBy('ref_kegiatan')->pluck('ref_kegiatan');

        $kegiatan = Kegiatan::select();

        // foreach ($nom as $a => $value) {
        //     $kegiatan = $kegiatan->OrWhere('id', $value);
        // }
        $kegiatan = $kegiatan->pluck('nama', 'id');



        // dd($nom);

        return response()->json($kegiatan);
    }


    public function sub(Request $request)
    {
        $nom = Nomenklatur::where('ref_urusan', $request->input('ref_urusan'))->where('ref_bidang_urusan', $request->input('ref_bidang_urusan'))->where('ref_program', $request->input('ref_program'))->where('ref_kegiatan', $request->input('ref_kegiatan'))->groupBy('ref_sub_kegiatan')->pluck('ref_sub_kegiatan');

        // $nom = Nomenklatur::where('ref_urusan', 1)->where('ref_bidang_urusan', 1)->where('ref_program', 159)->groupBy('ref_kegiatan')->pluck('ref_kegiatan');

        $sub_kegiatan = SubKegiatan::select();

        // foreach ($nom as $a => $value) {
        //     $sub_kegiatan = $sub_kegiatan->OrWhere('id', $value);
        // }
        $sub_kegiatan = $sub_kegiatan->pluck('nama', 'id');



        // dd($nom);

        return response()->json($sub_kegiatan);
    }

    public function bidang_filter(Request $request)
    {
        $nom = Nomenklatur::where('ref_urusan', $request->input('id'))->groupBy('ref_bidang_urusan')->pluck('ref_bidang_urusan');

        $bidang_urusan = BidangUrusan::select();

        // foreach ($nom as $a => $value) {
        //     $bidang_urusan = $bidang_urusan->OrWhere('id', $value);
        // }
        $bidang_urusan = $bidang_urusan->pluck('nama', 'id');



        // dd($bidang_urusan);

        return response()->json($bidang_urusan);
    }




    public function program_filter(Request $request)
    {
        $nom = Nomenklatur::where('ref_urusan', $request->input('ref_urusan'))->where('ref_bidang_urusan', $request->input('ref_bidang_urusan'))->groupBy('ref_program')->pluck('ref_program');

        $program = Program::select();

        // foreach ($nom as $a => $value) {
        //     $program = $program->OrWhere('id', $value);
        // }
        $program = $program->pluck('nama', 'id');



        // dd($bidang_urusan);

        return response()->json($program);
    }

    public function kegiatan_filter(Request $request)
    {
        $nom = Nomenklatur::where('ref_urusan', $request->input('ref_urusan'))->where('ref_bidang_urusan', $request->input('ref_bidang_urusan'))->where('ref_program', $request->input('ref_program'))->groupBy('ref_kegiatan')->pluck('ref_kegiatan');

        // $nom = Nomenklatur::where('ref_urusan', 1)->where('ref_bidang_urusan', 1)->where('ref_program', 159)->groupBy('ref_kegiatan')->pluck('ref_kegiatan');

        $kegiatan = Kegiatan::select();

        // foreach ($nom as $a => $value) {
        //     $kegiatan = $kegiatan->OrWhere('id', $value);
        // }
        $kegiatan = $kegiatan->pluck('nama', 'id');



        // dd($nom);

        return response()->json($kegiatan);
    }


    public function sub_filter(Request $request)
    {
        $nom = Nomenklatur::where('ref_urusan', $request->input('ref_urusan'))->where('ref_bidang_urusan', $request->input('ref_bidang_urusan'))->where('ref_program', $request->input('ref_program'))->where('ref_kegiatan', $request->input('ref_kegiatan'))->groupBy('ref_sub_kegiatan')->pluck('ref_sub_kegiatan');

        // $nom = Nomenklatur::where('ref_urusan', 1)->where('ref_bidang_urusan', 1)->where('ref_program', 159)->groupBy('ref_kegiatan')->pluck('ref_kegiatan');

        $sub_kegiatan = SubKegiatan::select();

        // foreach ($nom as $a => $value) {
        //     $sub_kegiatan = $sub_kegiatan->OrWhere('id', $value);
        // }
        $sub_kegiatan = $sub_kegiatan->pluck('nama', 'id');



        // dd($nom);

        return response()->json($sub_kegiatan);
    }
}
