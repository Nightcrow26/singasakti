<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengawasanProduk extends Model
{
    use HasFactory;
    
    protected $table = 'pengawasan_produk';

    protected $fillable = [
        'skpd_id',
        'nama',
        'tanggal_pengawasan',
        'kepemilikan_perizinan_berusaha',
        'keabsahan_perizinan_berusaha',
        'kapasitas_terpasang',
        'kepemilikan_bahanbaku',
        'keabsahan_bahanbaku',
    ];

    protected $casts = [
        'tanggal_pengawasan' => 'date',
    ];
}
