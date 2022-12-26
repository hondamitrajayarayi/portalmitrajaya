<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    public $connection = "INTRA";
    public $timestamps = false;
    protected $dates = ['create_date','last_update'];
    protected $table = 'INTRAMITRA.MST_BANK';
}
