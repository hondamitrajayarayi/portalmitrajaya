<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auth_user_group extends Model
{
    public function grup(){
        return $this->belongsTo('\App\Auth_group','groupId');
    }
}
