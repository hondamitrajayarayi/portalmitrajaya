<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrxRbTracking extends Model
{
    public $connection = "INTRA";
    public $timestamps = false;
    protected $table = 'INTRAMITRA.TRX_RB_TRACKING';

    protected $dates = ['created_date'];

    public function karyawan(){
        return $this->hasOne('\App\Karyawan','nik','id_user');
    }
    
}
