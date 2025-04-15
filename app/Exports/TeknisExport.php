<?php

namespace App\Exports;

use App\Models\trx_mr;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TeknisExport implements FromView, ShouldAutoSize

{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $data['data'] = trx_mr::with(['realisasi' => function ($query) {
            $query->orderBy('tgl_realisasi', 'desc');
        }])->with('skpd')->get();
        return view('excel.teknis.index', $data);
    //
    }
}
