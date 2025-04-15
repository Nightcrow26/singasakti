<?php

namespace App\Http\Controllers;

use App\Exports\RutinExport;
use Illuminate\Http\Request;
use App\Exports\TeknisExport;
use Maatwebsite\Excel\Facades\Excel;


class ExcelController extends Controller
{
    public function rutin(Request $request)
    {
        // $bulan = $request->input('bulan');
        return Excel::download(new RutinExport(), 'Laporan Pengawasan Rutin Singasakti.xlsx');
    }

    public function teknis(Request $request)
    {
        // $bulan = $request->input('bulan');
        return Excel::download(new TeknisExport(), 'Laporan Pengawasan Teknis Singasakti.xlsx');
    }
}
