<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    public $connection = "mysql";
    public function departemen(){
        return $this->belongsTo('\App\Departemen','id_bag_dept');
    }
    public function jabatan(){
        return $this->belongsTo('\App\Jabatan','id_jabatan');
    }
    public function cabang(){
        return $this->belongsTo('\App\Branch','branch_id', 'branch_id')->where('schema_name', $this->schema);
    }
    
    public function AuthUsergrup()
    {
        return $this->hasOne('\App\Auth_user_group','userId', 'nik');
        
    }
    public function user(){
        return $this->hasOne('\App\User','username', 'nik');
    }
    
}
