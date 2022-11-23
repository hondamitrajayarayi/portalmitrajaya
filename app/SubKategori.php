<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubKategori extends Model
{
    // protected $primaryKey = 'id_kategori';
    public function kategori(){
        return $this->belongsTo('\App\Kategori','id_kategori');
    }
}
