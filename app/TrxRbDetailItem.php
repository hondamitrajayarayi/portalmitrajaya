<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrxRbDetailItem extends Model
{
    public $connection = "INTRA";
    public $timestamps = false;
    protected $table = 'INTRAMITRA.TRX_RB_DETAIL_ITEM';

    public function TrxRbHeader()
    {
        return $this->belongsTo('\App\TrxRbHeader','rb_id','rb_id');
    }
}
