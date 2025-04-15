<?php

namespace App\Services;

use App\Models\Skpd;
use App\Models\User;
use App\Models\Aspek;
use App\Models\Domain;
use App\Models\Urusan;
use App\Models\Jawaban;
use App\Models\Program;
use App\Models\Kegiatan;
use App\Models\Indikator;
use App\Models\Nomenklatur;
use App\Models\SubKegiatan;
use App\Models\trx_program;
use App\Models\BidangUrusan;
use App\Models\trx_kegiatan;
use Illuminate\Http\Request;
use App\Models\trx_bidang_urusan;
use Illuminate\Support\Facades\DB;

class MasterService
{
    public function __construct()
    {
    //
    }

    function getDataSkpd($id = null)
    {
        if ($id === null) {
            $data = Skpd::get();
        }
        else {
            $data = Skpd::where('id', $id)->first();
        }
        return $data;
    }

    function getDataUser($id = null)
    {
        if ($id === null) {
            $data = User::with('skpd')->where('role', 'skpd')->get();
        }
        else {
            $data = User::with('skpd')->where('id', $id)->first();
        }
        return $data;
    }

    function getDataUrusan($id = null)
    {
        if ($id === null) {
            $data = Urusan::get();
        }
        else {
            $data = Urusan::where('id', $id)->first();
        }
        return $data;
    }

    function getDataBidang($id = null)
    {
        if ($id === null) {
            $data = BidangUrusan::get();
        }
        else {
            $data = BidangUrusan::where('id', $id)->first();
        }
        return $data;
    }

    function getDataProgram($id = null)
    {
        if ($id === null) {
            $data = Program::get();
        }
        else {
            $data = Program::where('id', $id)->first();
        }
        return $data;
    }

    function getDataKegiatan($id = null)
    {
        if ($id === null) {
            $data = Kegiatan::get();
        }
        else {
            $data = Kegiatan::where('id', $id)->first();
        }
        return $data;
    }

    function getDataSub($id = null)
    {
        if ($id === null) {
            $data = SubKegiatan::get();
        }
        else {
            $data = SubKegiatan::where('id', $id)->first();
        }
        return $data;
    }

    function getDataNomen($id = null)
    {
        if ($id === null) {
            $data = Nomenklatur::with('urusan')->with('bidang')->with('program')->with('kegiatan')->with('sub')->get();
        }
        else {
            $data = Nomenklatur::where('id', $id)->first();
        }
        return $data;
    }


    public static function storeSkpd(array $data)
    {
        $store =
            Skpd::create([
            "nama" => $data['nama'],
            "singkatan" => $data['singkatan'],
            "created_at" => now(),
            "updated_at" => now()
        ]);
        return true;
    }

    public static function storeMasterUser(array $data)
    {
        $trans = DB::transaction(function () use ($data) {
            $user = User::create([
                'username' => $data['name'],
                'name' => $data['name'],
                'skpd_id' => $data['skpd_id'],
                'role' => 'skpd',
                'password' => bcrypt($data['password']),
                'tahun' => '2024',
            ]);
            $user->assignRole('skpd');
        });
        return true;
    }


    public static function updateSkpd($id, array $data)
    {
        $find = Skpd::find($id);
        $toward =
        [
            "nama" => $data['nama'],
            "singkatan" => $data['singkatan'],
            "created_at" => now(),
            "updated_at" => now()
        ];
        $find->update($toward);
        return true;
    }

    public static function deleteDataSkpd($id)
    {
        try {
            Skpd::find($id)->delete();
            return true;
        }
        catch (\Throwable $th) {
            return false;
        }
    }

    public static function storeUrusan(Request $request)
    {
        $will_insert = $request->except(['_token']);
        $store = Urusan::create($will_insert);
        return true;
    }


    public static function updateUrusan(Request $request)
    {
        $will_insert = $request->except(['_token']);
        $store = Urusan::where('id', $request->input('id'))->update($will_insert);
        return true;
    }

    public static function deleteDataUrusan($id)
    {
        try {
            Urusan::find($id)->delete();
            return true;
        }
        catch (\Throwable $th) {
            return false;
        }
    }

    public static function storeBidang(Request $request)
    {
        $will_insert = $request->except(['_token']);
        $store = BidangUrusan::create($will_insert);
        return true;
    }


    public static function updateBidang(Request $request)
    {
        $will_insert = $request->except(['_token']);
        $store = BidangUrusan::where('id', $request->input('id'))->update($will_insert);
        return true;
    }

    public static function deleteDataBidang($id)
    {
        try {
            BidangUrusan::find($id)->delete();
            return true;
        }
        catch (\Throwable $th) {
            return false;
        }
    }

    public static function storeProgram(Request $request)
    {
        $will_insert = $request->except(['_token']);
        $store = Program::create($will_insert);
        return true;
    }


    public static function updateProgram(Request $request)
    {
        $will_insert = $request->except(['_token']);
        $store = Program::where('id', $request->input('id'))->update($will_insert);
        return true;
    }

    public static function deleteDataProgram($id)
    {
        try {
            Program::find($id)->delete();
            return true;
        }
        catch (\Throwable $th) {
            return false;
        }
    }

    public static function storeKegiatan(Request $request)
    {
        $will_insert = $request->except(['_token']);
        $store = Kegiatan::create($will_insert);
        return true;
    }


    public static function updateKegiatan(Request $request)
    {
        $will_insert = $request->except(['_token']);
        $store = Kegiatan::where('id', $request->input('id'))->update($will_insert);
        return true;
    }

    public static function deleteDataKegiatan($id)
    {
        try {
            Kegiatan::find($id)->delete();
            return true;
        }
        catch (\Throwable $th) {
            return false;
        }
    }

    public static function storeSub(Request $request)
    {
        $will_insert = $request->except(['_token']);
        $store = SubKegiatan::create($will_insert);
        return true;
    }


    public static function updateSub(Request $request)
    {
        $will_insert = $request->except(['_token']);
        $store = SubKegiatan::where('id', $request->input('id'))->update($will_insert);
        return true;
    }

    public static function deleteDataSub($id)
    {
        try {
            SubKegiatan::find($id)->delete();
            return true;
        }
        catch (\Throwable $th) {
            return false;
        }
    }

    public static function storeNomen(Request $request)
    {
        $will_insert = $request->except(['_token']);
        $store = Nomenklatur::create($will_insert);
        return true;
    }


    public static function updateNomen(Request $request)
    {
        $will_insert = $request->except(['_token']);
        $store = Nomenklatur::where('id', $request->input('id'))->update($will_insert);
        return true;
    }

    public static function deleteDataNomen($id)
    {
        try {
            Nomenklatur::find($id)->delete();
            return true;
        }
        catch (\Throwable $th) {
            return false;
        }
    }

    public static function deleteDataMasterUser($id)
    {
        try {
            User::find($id)->delete();
            return true;
        }
        catch (\Throwable $th) {
            return false;
        }
    }

    public static function updateUser($id, array $data)
    {

        $trans = DB::transaction(function () use ($data, $id) {
            $find = User::find($id);
            if ($data['password'] == null) {
                $toward =
                [
                    'username' => $data['username'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            else {
                $toward =
                [
                    'username' => $data['username'],
                    'password' => bcrypt($data['password']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            $find->update($toward);
        });
        return true;
    }

    public static function updateMasterUser($id, array $data)
    {

        $trans = DB::transaction(function () use ($data, $id) {
            $find = User::find($id);
            if ($data['password'] == null) {
                $toward =
                [
                    'username' => $data['name'],
                    'name' => $data['name'],
                    'skpd_id' => $data['skpd_id'],
                ];
            }
            else {
                $toward =
                [
                    'username' => $data['name'],
                    'name' => $data['name'],
                    'password' => bcrypt($data['password']),
                    'skpd_id' => $data['skpd_id'],
                ];
            }
            $find->update($toward);
        });
        return true;
    }
}
