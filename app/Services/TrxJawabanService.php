<?php

namespace App\Services;

use App\Models\Jawaban;
use App\Models\Indikator;

class TrxJawabanService
{
    public function __construct()
    {
        //
    }

    function getDataIndikator($id = null)
    {
        if ($id === null) {
            $data = Indikator::with('jawabans')->get();
        } else {
            $data =  Indikator::where('id', $id)->first();
        }
        return $data;
    }

    function getDataIndikatorskpd($id = null)
    {
        if ($id === null) {
            $data = Indikator::with('jawabans')->where('skpd_id', auth()->user()->skpd_id)->get();
        } else {
            $data =  Indikator::where('id', $id)->first();
        }
        return $data;
    }

    function getDataJawaban($id = null)
    {
        if ($id === null) {
            $data = Jawaban::get();
        } else {
            $data =  Jawaban::where('id', $id)->first();
        }
        return $data;
    }
}
