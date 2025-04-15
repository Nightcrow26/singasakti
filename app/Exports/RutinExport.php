<?php

namespace App\Exports;

use App\Models\trx_mr;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class RutinExport implements FromView, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $data['data'] = trx_mr::with(['realisasis' => function ($query) {
            $query->orderBy('tgl_realisasi', 'desc');
        }])->with('skpd')->get();

        return view('excel.rutin.index', $data);
    //
    }
}
