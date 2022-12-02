<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrxPeminjamanItem extends Model
{
    Public $connection = "INTRA";
    public $timestamps = false;
    protected $dates = ['created_date','updated_date'];
    protected $table = 'INTRAMITRA.TRX_PEMINJAMAN_DETAIL_ITEM';

    public function peminjaman(){
        return $this->hasOne('\App\TrxPeminjaman','id_pinjam','id_peminjaman');
    }
    public function inventaris()
    {
        return $this->hasOne('\App\TrxInventory','inventory_id','id_inventory');
    }
}
