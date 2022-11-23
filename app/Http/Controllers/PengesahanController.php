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
        $data = TrxRbHeader::where('status',2)
                ->orderBy('created_date', 'DESC')
                ->paginate(10);
        
        return view('transaksi.pengesahan_list', compact('data'));
    }
    public function riwayat()
    {
        $data = TrxRbHeader::whereNotIn('status',[1,2])
                ->orderBy('created_date', 'DESC')
                ->paginate(10);
        
        return view('transaksi.pengesahan_riwayat', compact('data'));
    }
}
