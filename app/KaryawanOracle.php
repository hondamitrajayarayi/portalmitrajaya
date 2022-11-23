<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KaryawanOracle extends Model
{
    public $connection = "INTRA";
    public $timestamps = false;
    protected $dates = ['created_at','updated_at'];
    protected $table = 'INTRAMITRA.MST_KARYAWAN';
}
