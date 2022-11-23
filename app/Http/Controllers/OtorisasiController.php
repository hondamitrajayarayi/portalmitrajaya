<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\TrxRbHeader;

class OtorisasiController extends Controller
{
    public function index()
    {
        $data = TrxRbHeader::where('status',6)
                ->orderBy('created_date', 'DESC')
                ->paginate(10);
        
        return view('transaksi.otorisasi_list', compact('data'));
    }
    public function riwayat()
    {
        $data = TrxRbHeader::where('status',0)
                ->orderBy('created_date', 'DESC')
                ->paginate(10);
        
        return view('transaksi.otorisasi_riwayat', compact('data'));
    }
}
