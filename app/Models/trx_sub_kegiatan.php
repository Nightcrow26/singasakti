<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trx_sub_kegiatan extends Model
{
    //
    protected $connection = 'mysql';
    protected $table = 'trx_sub_kegiatan';
    protected $guarded = [''];

    public function nama_sub_kegiatan()
    {
        return $this->hasMany(SubKegiatan::class , 'id', 'ref_sub_kegiatan_id');
    }

    public function nama_sub_kegiatans()
    {
        return $this->hasOne(SubKegiatan::class , 'id', 'ref_sub_kegiatan_id');
    }

    public function targets()
    {
        return $this->hasMany(trx_pagu::class , 'trx_sub_kegiatan_id', 'id');
    }

    public function targets_ref()
    {
        return $this->hasMany(trx_pagu::class , 'ref_sub_kegiatan_id', 'ref_sub_kegiatan_id');
    }

    public function realisasis()
    {
        return $this->hasMany(trx_realisasi::class , 'trx_sub_kegiatan_id', 'id');
    }

    public function fisiks()
    {
        return $this->hasMany(trx_fisik::class , 'trx_sub_kegiatan_id', 'id');
    }

    public function targets_gajih()
    {
        return $this->hasMany(trx_pagu::class , 'trx_sub_kegiatan_id', 'id')->where('ref_sub_kegiatan_id', '!=', '1935');
    }

    public function realisasis_gajih()
    {
        return $this->hasMany(trx_realisasi::class , 'trx_sub_kegiatan_id', 'id')->where('ref_sub_kegiatan_id', '!=', '1935');
    }

    public function fisiks_gajih()
    {
        return $this->hasMany(trx_fisik::class , 'trx_sub_kegiatan_id', 'id')->where('ref_sub_kegiatan_id', '!=', '1935');
    }

    public function nomenklatur()
    {
        return $this->hasOne(Nomenklatur::class , 'ref_urusan', 'ref_urusan_id')
            ->where('ref_bidang_urusan', $this->ref_bidang_urusan_id)
            ->where('ref_program', $this->ref_program_id)
            ->where('ref_kegiatan', $this->ref_kegiatan_id)
            ->where('ref_sub_kegiatan', $this->ref_sub_kegiatan_id);
    }

    public function mrs()
    {
        return $this->hasMany(trx_mr::class , 'trx_sub_kegiatan_id', 'id');
    }
}
