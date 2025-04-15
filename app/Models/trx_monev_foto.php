<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trx_monev_foto extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'trx_monev_foto';
    protected $guarded = [''];
}
