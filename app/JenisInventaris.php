<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisInventaris extends Model
{
    public $connection = "MITRA";
    public $timestamps = false;
    protected $dates = ['create_date','update_date'];
    protected $table = 'MITRA.MST_JENIS_INVENTARIS';
}
