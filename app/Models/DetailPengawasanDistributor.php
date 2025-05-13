<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPengawasanDistributor extends Model
{
    use HasFactory;

    protected $table = 'detail_pengawasan_distributor';

    protected $fillable = [
        'pengawasan_distributor_id',
        'nama_varian_produk',
        'nama_sub_varian_produk',
        'merk_produk',
        'sertifikat_tkdn',
        'sertifikat_sni',
        'pencatatan_simpk',
    ];

    // Relasi ke induk pengawasan
    public function distributor()
    {
        return $this->belongsTo(PengawasanDistributor::class, 'pengawasan_distributor_id');
    }
}
