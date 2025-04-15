<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKegiatan extends Model
{
    //
    protected $connection = 'mysql';
    protected $table = 'ref_sub_kegiatan';
    protected $guarded = [''];
}
