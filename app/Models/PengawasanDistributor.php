<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengawasanDistributor extends Model
{
    use HasFactory;
    
    protected $table = 'pengawasan_distributor';

    protected $fillable = [
        'skpd_id',
        'nama',
        'tanggal_pengawasan',
        'kepemilikan_perizinan_berusaha',
        'keabsahan_perizinan_berusaha',
    ];

    protected $casts = [
        'tanggal_pengawasan' => 'date',
    ];
}
