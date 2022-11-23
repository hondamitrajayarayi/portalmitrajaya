<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teknisi extends Model
{
    public function karyawan(){
        return $this->belongsTo('\App\Karyawan','nik','nik');
    }
    public function kategori(){
        return $this->belongsTo('\App\Kategori','id_kategori');
    }

    public function user(){
        return $this->belongsTo('\App\User','nik','username');
    }
}
