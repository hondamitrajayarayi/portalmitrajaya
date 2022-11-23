<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrxRbDetailDokumen extends Model
{
    public $connection = "INTRA";
    public $timestamps = false;
    protected $table = 'INTRAMITRA.TRX_RB_DETAIL_DOKUMEN';

    public function TrxRbHeader()
    {
        return $this->belongsTo('\App\TrxRbHeader','rb_id','rb_id');
    }
}
