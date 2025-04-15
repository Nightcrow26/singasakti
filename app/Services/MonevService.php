<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\UploadRepository;
use App\Models\trx_monev_foto;

class MonevService
{
    public function __construct()
    {
    //
    }

    public static function storeFoto(Request $request)
    {
        $repo = new UploadRepository();
        DB::transaction(function () use ($request) {
            if ($request->hasFile('foto')) {
                foreach ($request->file('foto') as $i => $file) {
                    trx_monev_foto::create([
                        'skpd_id' => $request->skpd_id,
                        'trx_monev_id' => $request->trx_monev_id,
                        'ket' => $request->ket,
                        'tahun' => $request->tahun,
                        'original_name' => $file->getClientOriginalName(),
                        'foto' => $file->store('foto', 'public'),
                    ]);
                }
            }
        });
        return true;
    }
}
