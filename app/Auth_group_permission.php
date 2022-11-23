<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auth_group_permission extends Model
{
    public function permission(){
        return $this->belongsTo('\App\Auth_permission','permission_id','id');
    }
}
