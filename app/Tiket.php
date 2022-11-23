<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    protected $fillable = [
        'reported','id_kategori', 'id_kondisi','subjek_masalah','deskripsi_masalah','foto','file','status','progress','tgl_proses'
    ];

    public function kondisi(){
        return $this->belongsTo('\App\Kondisi','id_kondisi');
    }

    public function kategori(){
        return $this->belongsTo('\App\Kategori','id_kategori');
    }

    public function karyawan(){
        return $this->belongsTo('\App\Karyawan','reported','nik');
    }

    public function teknisi(){
        return $this->belongsTo('\App\Karyawan','id_teknisi','nik');
    }

    public function user(){
        return $this->belongsTo('\App\User','reported','username');
    }

    public function dokumenfoto(){
        return $this->belongsTo('\App\Dokumen','foto','idDokumen');
    }

    public function dokumenfile(){
        return $this->belongsTo('\App\Dokumen','file','idDokumen');
    }
    public function ratting(){
        return $this->belongsTo('\App\Rating','idTiket','id_ticket');
    }
}
