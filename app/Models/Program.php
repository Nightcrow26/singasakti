<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    //
    protected $connection = 'mysql';
    protected $table = 'ref_program';
    protected $guarded = [''];
}
