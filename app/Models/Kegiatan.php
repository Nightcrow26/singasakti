<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    //
    protected $connection = 'mysql';
    protected $table = 'ref_kegiatan';
    protected $guarded = [''];
}
