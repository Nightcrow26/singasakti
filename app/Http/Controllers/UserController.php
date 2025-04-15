<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MasterService;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

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
        $validator = Validator::make(request()->all(), [
            'username' => 'required|unique:users,username,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => "failed",
                "message" => $validator->errors()->first(),
            ]);
        } else {
            $store = $this->service->updateUser($id, $request->all());
            if ($store == true) {
                return response()->json([
                    "status" => "success",
                    "messages" => "Berhasil memperbaharui Data",
                ]);
            } else {
                return response()->json([
                    "status" => "failed",
                    "messages" => "Gagal memperbaharui Data",
                ]);
            }
        }
    }
}
