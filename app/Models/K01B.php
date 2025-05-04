<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class K01B extends Model
{
    use HasFactory;

    // Tentukan nama tabel (jika tabel tidak mengikuti konvensi Laravel)
    protected $table = 'k01b';

    protected $fillable = [
        'skpd_id',
        'nib',
        'nm_badan_usaha',
        'pjbu',
        'jenis',
        'sifat',
        'klasifikasi',
        'layanan',
        'bentuk',
        'kualifikasi',
        'pm_sbu',
        'pm_nib',
        'pl_peng_usaha_berkelanjutan',
        'data_dukung'
    ];
}
