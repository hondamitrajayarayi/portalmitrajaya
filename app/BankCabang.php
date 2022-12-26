<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankCabang extends Model
{
    public $connection = "INTRA";
    public $timestamps = false;
    protected $dates = ['create_date','last_update'];
    protected $table = 'INTRAMITRA.MST_BANK_BRANCH';

    public function bank(){
        return $this->belongsTo('\App\Bank','bank_id','bank_id');
    }
}
