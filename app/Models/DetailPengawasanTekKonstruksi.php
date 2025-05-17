<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPengawasanTekKonstruksi extends Model
{
   use HasFactory;

    protected $table = 'detail_pengawasan_tek_konstruksi';

    protected $fillable = [
        'pengawasan_tek_konstruksi_id',
        'nama_teknologi',
        'bidang_usaha',
        'haki',
        'no_haki',
    ];

    // Relasi ke induk pengawasan
    public function pengawasan()
    {
        return $this->belongsTo(PengawasanTekKonstruksi::class, 'pengawasan_tek_konstruksi_id');
    }
}
