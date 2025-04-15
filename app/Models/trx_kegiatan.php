<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trx_kegiatan extends Model
{
    protected $connection = 'mysql';
    protected $table = 'trx_kegiatan';
    protected $guarded = [''];

    public function sub_kegiatans()
    {
        return $this->hasMany(trx_sub_kegiatan::class , 'trx_kegiatan_id', 'id');
    }

    public function sub_kegiatans_ref()
    {
        return $this->hasMany(trx_sub_kegiatan::class , 'ref_kegiatan_id', 'ref_kegiatan_id');
    }

    public function nama_kegiatan()
    {
        return $this->hasMany(Kegiatan::class , 'id', 'ref_kegiatan_id');
    }

    public function nama_kegiatans()
    {
        return $this->hasOne(Kegiatan::class , 'id', 'ref_kegiatan_id');
    }

    public function nomenklatur()
    {
        return $this->hasOne(Nomenklatur::class , 'ref_urusan', 'ref_urusan_id')
            ->where('ref_bidang_urusan', $this->ref_bidang_urusan_id)
            ->where('ref_program', $this->ref_program_id)
            ->where('ref_kegiatan', $this->ref_kegiatan_id);
    }
}
