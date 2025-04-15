<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\trx_monev_foto;

class UploadRepository
{
    public function __construct()
    {
    //
    }

    public function StoreFoto(Request $request, $id = null)
    {
        if ($id == null) {
            $file = $request->file('foto');
            $store = $request->file('foto')->store('foto', 'public');
            return $store;
        }
        else {
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $store = $request->file('foto')->store('foto', 'public');
                return $store;
            }
            else {
                return trx_monev_foto::find($id)->bukti;
            }
        }
    }
}
