<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class K02 extends Model
{
    use HasFactory;

    // Tentukan nama tabel (jika tabel tidak mengikuti konvensi Laravel)
    protected $table = 'k02';

    // Tentukan kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'skpd_id',
        'kegiatan_konstruksi',
        'no_kontrak',
        'nm_bujk',
        'proses_pemilihan_penyedia_jasa',
        'penerapan_standar_kontrak',
        'penggunaan_tenaga_kerja_bersertifikat',
        'pemberian_pekerjaan_utama_subpenyedia',
        'ketersediaan_dokumen_standar_k4',
        'penerapan_smkk',
        'kegiatan_antisipasi_kecelakaan_kerja',
        'penerapan_sistem_manajemen_mutu_konstruksi',
        'pemenuhan_peralatan_pelaksanaan_proyek',
        'penggunaan_material_standar',
        'penggunaan_produk_dalam_negeri',
        'pemenuhan_standar_mutu_material',
        'pemenuhan_standar_teknis_lingkungan',
        'pemenuhan_standar_k3',
        'data_dukung',
    ];
}
