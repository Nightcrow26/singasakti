<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Urusan extends Model
{
    //
    protected $connection = 'mysql';
    protected $table = 'ref_urusan';
    protected $guarded = [''];

    public function nama_urusans()
    {
        return $this->hasMany(trx_urusan::class , 'urusan_id', 'id');
    }

    public function bidang_urusans()
    {
        return $this->hasMany(trx_bidang_urusan::class , 'trx_urusan_id', 'id');
    }
}
