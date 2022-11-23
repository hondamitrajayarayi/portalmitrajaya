<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    public $connection = "MITRA";
    public $timestamps = false;
    protected $table = 'MITRA.VI_MST_BRANCH_KONSOL';

    public function karyawan(){
        return $this->belongsTo('\App\Karyawan','branch_id', 'branch_id')->where('schema', $this->id);
    }

    public function trxrbheader(){
        return $this->belongsTo('\App\TrxRbHeader','branch_id', 'branch_id')->where('schema_name', $this->id);
    }
}
