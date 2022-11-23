<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrxRbDetailApproval extends Model
{
    public $connection = "INTRA";
    public $timestamps = false;
    protected $dates = ['approve_date'];
    protected $table = 'INTRAMITRA.TRX_RB_DETAIL_APPROVAL';

    public function karyawan(){
        return $this->hasOne('\App\Karyawan','nik','approve_by');
    }
    public function trxheader(){
        return $this->hasOne('\App\TrxRbHeader','rb_id','rb_id');
    }
}
