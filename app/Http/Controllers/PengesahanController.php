<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\TrxRbHeader;
use App\TrxRbTracking;
use App\TrxRbDetailApproval;
use App\Karyawan;

class PengesahanController extends Controller
{
    public function index()
    {
        // khusus untuk admin ho
        if(Auth::user()->ugrup->groupId == 20){

            $data = TrxRbHeader::where('status',2)
                    ->orderBy('created_date', 'DESC')
                    ->paginate(10);
        }else{
            $data = [];
        }
        
        return view('transaksi.pengesahan_list', compact('data'));
    }
    public function riwayat()
    {
        if(Auth::user()->ugrup->groupId == 20){
            $data = TrxRbHeader::whereNotIn('status',[1,2])
                ->orderBy('created_date', 'DESC')
                ->paginate(10);
        }else{
            $data = [];
        }
        
        return view('transaksi.pengesahan_riwayat', compact('data'));
    }
}
