<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrxPeminjaman extends Model
{
    public $connection = "INTRA";
    public $timestamps = false;
    protected $dates = ['created_date','updated_date','estimasi_balik', 'tgl_pinjam','tgl_balik'];
    protected $table = 'INTRAMITRA.TRX_PEMINJAMAN';

    public function inventaris()
    {
        return $this->hasOne('\App\TrxInventory','inventory_id','id_inventaris');
    }
    public function ditem(){
        return $this->hasMany('\App\TrxPeminjamanItem','id_peminjaman','id_pinjam');
    }
}
