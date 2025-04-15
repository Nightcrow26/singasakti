<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trx_bidang_urusan extends Model
{
    protected $connection = 'mysql';
    protected $table = 'trx_bidang_urusan';
    protected $guarded = [''];

    public function urusan()
    {
        return $this->belongsTo(trx_urusan::class , 'id', 'trx_bidang_urusan_id');
    }

    public function nama_bidangs()
    {
        return $this->hasMany(BidangUrusan::class , 'id', 'ref_bidang_urusan_id');
    }

    public function nama_bidang()
    {
        return $this->hasOne(BidangUrusan::class , 'id', 'ref_bidang_urusan_id');
    }

    public function programs()
    {
        return $this->hasMany(trx_program::class , 'trx_bidang_urusan_id', 'id');
    }

    public function programs_ref()
    {
        return $this->hasMany(trx_program::class , 'ref_bidang_urusan_id', 'ref_bidang_urusan_id');
    }

    public function nomenklatur()
    {
        return $this->hasOne(Nomenklatur::class , 'ref_urusan', 'ref_urusan_id')
            ->where('ref_bidang_urusan', $this->ref_bidang_urusan_id);
    }
}
