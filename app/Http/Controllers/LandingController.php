<?php

namespace App\Http\Controllers;

use App\Models\Skpd;
use App\Models\Domain;
use App\Models\trx_mr;
use App\Models\Indikator;
use Illuminate\Http\Request;
use App\Models\trx_realisasi_mr;
use App\Models\trx_upload_berkas;
use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{
    //
    public function index()
    {
        $data['pekerjaan'] = trx_mr::count();

        $data['realisasi'] = trx_mr::with(['realisasis' => function ($query) {
            $query->orderBy('tgl_realisasi', 'desc');
        }])->get();


        $data['total_pekerjaan'] = trx_mr::count();



        $data['total_lengkap'] = trx_upload_berkas::whereNotNull('up_1')
            ->whereNotNull('up_2')
            ->whereNotNull('up_3')
            ->whereNotNull('up_4')
            ->whereNotNull('up_5')
            ->whereNotNull('up_6')
            ->whereNotNull('up_7')
            ->whereNotNull('up_8')
            ->whereNotNull('up_9')
            ->count();

        $data['total_tidak_lengkap'] = trx_upload_berkas::whereNull('up_1')
            ->orWhereNull('up_2')
            ->orWhereNull('up_3')
            ->orWhereNull('up_4')
            ->orWhereNull('up_5')
            ->orWhereNull('up_6')
            ->orWhereNull('up_7')
            ->orWhereNull('up_8')
            ->orWhereNull('up_9')
            ->count();


        return view('welcome', $data);
    }
}
