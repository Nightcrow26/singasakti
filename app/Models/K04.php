<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class K04 extends Model
{
    use HasFactory;

    // Tentukan nama tabel (jika tabel tidak mengikuti konvensi Laravel)
    protected $table = 'k04';

    // Tentukan kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'skpd_id',
        'nib',
        'nama_usaha',
        'no_sertif',
        'alamat',
        'hasil',
        'data_dukung',
    ];
}