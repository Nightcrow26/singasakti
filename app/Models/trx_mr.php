<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trx_mr extends Model
{

    protected $connection = 'mysql';
    protected $table = 'trx_monev';
    protected $guarded = [''];

    public function realisasis()
    {
        return $this->hasMany(trx_realisasi_mr::class , 'trx_monev_id', 'id');
    }

    public function urusan()
    {
        return $this->hasOne(Urusan::class , 'id', 'ref_urusan_id');
    }

    public function bidang()
    {
        return $this->hasOne(BidangUrusan::class , 'id', 'ref_bidang_urusan_id');
    }

    public function sub()
    {
        return $this->hasOne(SubKegiatan::class , 'id', 'ref_sub_kegiatan_id');
    }

    public function prog()
    {
        return $this->hasOne(Program::class , 'id', 'ref_program_id');
    }
    public function keg()
    {
        return $this->hasOne(Kegiatan::class , 'id', 'ref_kegiatan_id');
    }

    public function skpd()
    {
        return $this->hasOne(Skpd::class , 'id', 'skpd_id');
    }

    public function realisasi()
    {
        return $this->hasOne(trx_realisasi_mr::class , 'trx_monev_id', 'id');
    }


    public function foto()
    {
        return $this->hasMany(trx_monev_foto::class , 'trx_monev_id', 'id');
    }

    public function berkas()
    {
        return $this->hasOne(trx_upload_berkas::class , 'trx_monev_id', 'id');
    }

}
