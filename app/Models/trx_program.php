<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trx_program extends Model
{
    protected $connection = 'mysql';
    protected $table = 'trx_program';
    protected $guarded = [''];

    public function kegiatans()
    {
        return $this->hasMany(trx_kegiatan::class , 'trx_program_id', 'id');
    }

    public function kegiatans_ref()
    {
        return $this->hasMany(trx_kegiatan::class , 'ref_program_id', 'ref_program_id');
    }

    public function nama_program()
    {
        return $this->hasMany(Program::class , 'id', 'ref_program_id');
    }

    public function nama_programs()
    {
        return $this->hasOne(Program::class , 'id', 'ref_program_id');
    }

    public function nomenklatur()
    {
        return $this->hasOne(Nomenklatur::class , 'ref_urusan', 'ref_urusan_id')
            ->where('ref_bidang_urusan', $this->ref_bidang_urusan_id)
            ->where('ref_program', $this->ref_program_id);
    }
}
