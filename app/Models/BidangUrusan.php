<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidangUrusan extends Model
{
    //
    protected $connection = 'mysql';
    protected $table = 'ref_bidang_urusan';
    protected $guarded = [''];
}
