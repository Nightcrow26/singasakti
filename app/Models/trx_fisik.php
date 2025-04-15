<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trx_fisik extends Model
{
    //
    protected $connection = 'mysql';
    protected $table = 'trx_fisik';
    protected $guarded = [''];
}
