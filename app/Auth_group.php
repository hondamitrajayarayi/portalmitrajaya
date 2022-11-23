<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auth_group extends Model
{
    public function gpermission(){
        return $this->hasMany('\App\Auth_group_permission','group_id');
    }
}
