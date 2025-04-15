<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trx_realisasi_mr extends Model
{
    //

    protected $connection = 'mysql';
    protected $table = 'trx_realisasi_monev';
    protected $guarded = [''];
}
