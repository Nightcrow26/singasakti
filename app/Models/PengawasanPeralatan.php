<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengawasanPeralatan extends Model
{
    use HasFactory;
    
    protected $table = 'pengawasan_peralatan';

    protected $fillable = [
        'skpd_id',
        'nama_pemilik_peralatan_bujk',
        'tanggal_pengawasan',
        'kepemilikan_perizinan_berusaha',
        'keabsahan_perizinan_berusaha',
    ];

    protected $casts = [
        'tanggal_pengawasan' => 'date',
    ];
}
