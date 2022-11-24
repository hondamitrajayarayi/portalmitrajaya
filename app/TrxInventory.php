<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrxInventory extends Model
{
    public $connection = "INTRA";
    public $timestamps = false;
    protected $dates = ['created_date','updated_date'];
    protected $table = 'INTRAMITRA.TRX_INVENTORY';

    public function TrxRbHeader()
    {
        return $this->hasOne('\App\TrxRbHeader','rb_id','rb_id');
    }
    public function grupinventaris()
    {
        return $this->hasOne('\App\GrupInventaris','group_id','grup_id');
    }
    public function jenisinventaris()
    {
        return $this->hasOne('\App\JenisInventaris','jenis_id', 'jenis_id')->where('group_id', $this->grup_id);
    }
    public function karyawan(){
        return $this->hasOne('\App\Karyawan','nik','created_by');
    }
    public function cabang(){
        return $this->hasOne('\App\Branch','branch_id', 'branch_id')->where('schema_name', $this->schema);
    }
}
