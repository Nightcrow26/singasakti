<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trx_upload extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'trx_monev_upload';
    protected $guarded = [''];
}
