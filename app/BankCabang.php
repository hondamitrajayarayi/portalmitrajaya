<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankCabang extends Model
{
    public $connection = "MITRA";
    public $timestamps = false;
    protected $table = 'MITRA.MST_BANK_BRANCH';
}
