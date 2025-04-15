<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nomenklatur extends Model
{
    //
    protected $connection = 'mysql';
    protected $table = 'nomenklatur_perencanaan';
    protected $guarded = [''];

    public function urusan()
    {
        return $this->hasOne(Urusan::class , 'id', 'ref_urusan');
    }

    public function bidang()
    {
        return $this->hasOne(BidangUrusan::class , 'id', 'ref_bidang_urusan');
    }

    public function program()
    {
        return $this->hasOne(Program::class , 'id', 'ref_program');
    }

    public function kegiatan()
    {
        return $this->hasOne(Kegiatan::class , 'id', 'ref_kegiatan');
    }

    public function sub()
    {
        return $this->hasOne(SubKegiatan::class , 'id', 'ref_sub_kegiatan');
    }
}
