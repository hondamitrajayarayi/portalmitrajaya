<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrxRbHeader extends Model
{
    public $connection = "INTRA";
    public $timestamps = false;
    protected $dates = ['created_date','rb_date','update_date'];
    protected $table = 'INTRAMITRA.TRX_RB_HEADER';

    public function karyawan(){
        return $this->hasOne('\App\Karyawan','nik','created_by');
    }

    public function TrxRbDetailDokumen(){
        return $this->hasMany('\App\TrxRbDetailDokumen','rb_id','rb_id');
    }

    public function TrxRbDetailItem(){
        return $this->hasMany('\App\TrxRbDetailItem','rb_id','rb_id');
    }
    public function TrxRbDetailApprove(){
        return $this->hasMany('\App\TrxRbDetailApproval','rb_id','rb_id');
    }
    public function cabang(){
        return $this->hasOne('\App\Branch','branch_id', 'branch_id')->where('schema_name', $this->schema_name);
    }
}
