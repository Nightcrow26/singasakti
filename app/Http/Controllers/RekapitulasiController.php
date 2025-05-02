<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RekapitulasiController extends Controller
{
    public function k01a()
    {
        return view('admin.monev.k01a.index');
    }

    public function k01b()
    {
        return view('admin.monev.k01b.index');
    }
}
