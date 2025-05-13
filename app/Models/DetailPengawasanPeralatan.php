<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPengawasanPeralatan extends Model
{
    use HasFactory;

    protected $table = 'detail_pengawasan_peralatan';

    protected $fillable = [
        'pengawasan_peralatan_id',
        'nama_varian_peralatan',
        'nama_sub_varian_peralatan',
        'merk_peralatan',
        'jumlah_unit',
        'surat_keterangan_k3',
        'bukti_kepemilikan',
        'pencatatan_simpk',
        'nomor_registrasi_simpk',
    ];

    // Relasi ke induk pengawasan
    public function pengawasan()
    {
        return $this->belongsTo(PengawasanPeralatan::class, 'pengawasan_peralatan_id');
    }
}
