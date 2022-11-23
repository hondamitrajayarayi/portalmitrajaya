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
        return $this->belongsTo('\App\TrxRbHeader','rb_id','rb_id');
    }
}
