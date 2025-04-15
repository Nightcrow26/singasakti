<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trx_urusan extends Model
{
    protected $connection = 'mysql';
    protected $table = 'trx_urusan';
    protected $guarded = [''];

    public function bidang_urusans()
    {
        return $this->hasMany(trx_bidang_urusan::class , 'trx_urusan_id', 'id');
    }

    public function bidang_urusans_ref()
    {
        return $this->hasMany(trx_bidang_urusan::class , 'ref_urusan_id', 'ref_urusan_id');
    }

    public function nama_urusans()
    {
        return $this->hasMany(Urusan::class , 'id', 'ref_urusan_id');
    }

    public function nama_urusan()
    {
        return $this->hasOne(Urusan::class , 'id', 'ref_urusan_id');
    }

    public function skpd()
    {
        return $this->hasOne(User::class , 'id', 'user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }

    public function nomenklatur()
    {
        return $this->hasOne(Nomenklatur::class , 'ref_urusan', 'ref_urusan_id');
    }
}
