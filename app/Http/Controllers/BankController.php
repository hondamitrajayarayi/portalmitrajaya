<?php

namespace App\Http\Controllers;

use App\Bank;
use App\BankCabang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BankController extends Controller
{
    public function index()
    {
        $data = BankCabang::orderby('last_update', 'desc')->paginate(20);
        $bank = Bank::all();
        
        return view('master.bank', compact('data','bank'));
    }
    public function cari(Request $request)
    {
        $bank = Bank::all();
        $search = $request->get('search');
        $data = BankCabang::when($search, function ($sql) use ($search) {
            $sql->where('bank_account_no', 'like', '%' . $search . '%')
                ->orWhere('bank_account_name', 'like', '%' . strtoupper($search) . '%')
                ->orWhere('bank_branch_name', 'like', '%' . strtoupper($search) . '%')
                ->orderby('last_update', 'desc');
            })
            ->paginate(20);

        return view('master.bank', compact('data','bank'));
    }
    public function simpan(Request $request)
    {
        $cek = BankCabang::where('bank_account_no', $request->norek)->count();
        if($cek != 0){
            return redirect()->route('bank')->with('messageWarning','Rekening Sudah ada!');
        }else{
    
            $bank = Bank::where('bank_id', $request->bank)->first();
            $data = [
                'bank_branch_id'    => $this->BankCabangId(),
                'bank_id'           => $request->bank,
                'bank_branch_name'  => $bank->bank_name .' '. $request->norek, //kombinasi
                'create_user'       => Auth::user()->name,
                'last_user'         => Auth::user()->name,
                'create_date'       => date('Y-m-d H:i:s'), 
                'last_update'       => date('Y-m-d H:i:s'),
                'status'            => 1,
                'bank_account_no'   => $request->norek,
                'bank_account_name' => $request->nama,
            ];

            BankCabang::insert($data);
    
            return redirect()->route('bank')->with('message','Data Berhasil Disimpan!');
        }
    }

    public function BankCabangId()
    {
        $q = BankCabang::select(DB::raw('max(SUBSTR(MST_BANK_BRANCH.BANK_BRANCH_ID,13)) as BANK'))
            ->get();
        $year = substr(date('Y'), -2);
        if (count($q) != 0) {
            foreach ($q as $k) {
                $tmp = ((int)$k->bank) + 1;
                
                $kd = 'BBI' . "-" . $year . "-". sprintf("%07s", $tmp);  
            }
        }
        else {
            $kd = 'BBI' . "-" . $year . "-". "-0000001";
        }

        return $kd;
    }
    public function edit($id)
    {
        $data = BankCabang::where('bank_branch_id', '=', $id)->first();
        
        return response()->json($data);
    }
    public function update(Request $request)
    {
        $bank = Bank::where('bank_id', $request->bank)->first();
        $data = [
            'bank_id'           => $request->bank,
            'bank_branch_name'  => $bank->bank_name .' '. $request->norek, //kombinasi
            'last_user'         => Auth::user()->name,
            'last_update'       => date('Y-m-d H:i:s'),
            'status'            => $request->status,
            'bank_account_no'   => $request->norek,
            'bank_account_name' => $request->nama,
        ];
        
        BankCabang::where('bank_branch_id', $request->id)->update($data);

        return redirect()->back()->with('message','Data Berhasil Diubah!');

    }
    public function hapus($id)
    {
        BankCabang::where('bank_branch_id', $id)->delete();

        return redirect()->back()->with('message','Data Berhasil Dihapus!');
    }
}
