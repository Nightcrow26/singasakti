<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class K03 extends Model
{
    use HasFactory;

    // Tentukan nama tabel (jika tabel tidak mengikuti konvensi Laravel)
    protected $table = 'k03';

    // Tentukan kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'skpd_id',
        'nama_bangunan',
        'no_kontrak',
        'lokasi',
        'tgl_thn_pembangunan',
        'tgl_thn_pemanfaatan',
        'umur_konstruksi',
        'kesesuaian_fungsi',
        'kesesuaian_lokasi',
        'rencana_umur',
        'kapasitas_beban',
        'pemeliharaan_bangunan',
        'program_pemeliharaan',
        'data_dukung',
    ];
}