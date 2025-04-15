<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tahun extends Model
{
    //
    protected $connection = 'mysql';
    protected $table = 'tbl_master_tahun';
    protected $guarded = [''];
}
