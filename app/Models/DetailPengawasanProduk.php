<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPengawasanProduk extends Model
{
    use HasFactory;

    protected $table = 'detail_pengawasan_produk';

    protected $fillable = [
        'pengawasan_produk_id',
        'nama_varian_produk',
        'nama_sub_varian_produk',
        'merk_produk',
        'sertifikat_tkdn',
        'sertifikat_sni',
        'pencatatan_simpk',
        'nomor_registrasi_simpk',
    ];

    // Relasi ke induk pengawasan
    public function produk()
    {
        return $this->belongsTo(PengawasanProduk::class, 'pengawasan_produk_id');
    }
}
