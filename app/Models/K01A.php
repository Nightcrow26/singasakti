<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class K01A extends Model
{
    use HasFactory;

    // Tentukan nama tabel (jika tabel tidak mengikuti konvensi Laravel)
    protected $table = 'k01a';

    protected $fillable = [
        'skpd_id',
        'nib',
        'nm_usaha_rantai_pasok',
        'pjbu',
        'kep_keab_perizinan_berusaha',
        'kep_keab_perizinan_teknologi',
        'pencatatan_dalam_simpk',
        'data_dukung'
    ];
}
