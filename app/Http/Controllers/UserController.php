<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MasterService;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $service;

    public function __construct()
    {
        $this->service = new MasterService;
    }

    public function index()
    {
        return view('user.index');
    }

    public function updateuser(Request $request)
    {
        $id = $request->id;

        // Tambahkan validasi untuk address, latitude, longitude
        $validator = Validator::make($request->all(), [
            'username'   => 'required|unique:users,username,' . $id,
            'address'    => 'nullable|string|max:500',
            'latitude'   => 'nullable|numeric',
            'longitude'  => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status"  => "failed",
                "message" => $validator->errors()->first(),
            ]);
        }

        // Ambil hanya field yang diperlukan
        $data = $request->only(['username', 'password', 'address', 'latitude', 'longitude']);

        $store = $this->service->updateUser($id, $data);
        if ($store) {
            return response()->json([
                "status"   => "success",
                "messages" => "Berhasil memperbaharui Data",
            ]);
        } else {
            return response()->json([
                "status"   => "failed",
                "messages" => "Gagal memperbaharui Data",
            ]);
        }
    }
}
