<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    public function karyawan(){
        return $this->belongsTo('\App\Karyawan','id_user','nik');
    }
}
