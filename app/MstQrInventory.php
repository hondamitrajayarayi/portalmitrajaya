<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MstQrInventory extends Model
{
    public $connection = "INTRA";
    public $timestamps = false;
    protected $dates = ['created_date'];
    protected $table = 'INTRAMITRA.MST_QR_INVENTORY';

    public function inventory()
    {
        return $this->belongsTo('\App\TrxInventory','inventory_id','inventory_id');
    }
}
