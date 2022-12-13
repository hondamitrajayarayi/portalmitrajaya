<?php

namespace App\Http\Controllers;

use App\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Karyawan;
use App\User;
use App\TrxRbHeader;
use App\TrxRbDetailItem;
use App\TrxRbDetailDokumen;
use App\TrxRbDetailApproval;
use App\TrxRbTracking;

class PengajuanController extends Controller
{
    public function index()
    {

        $user = Karyawan::where('nik', '=', Auth::user()->username)->first();
        $kodeRb = $this->getKodeRB($user);
        $tanggal = date('d F Y');
        $diketahui = Karyawan::where('id_jabatan',1)
                    ->orWhere('id_jabatan',2)
                    ->orWhere('id_jabatan',3)->get();
        // dd($kodeRb);
        return view('transaksi.pengajuan', compact('user','kodeRb','tanggal','diketahui'));
    }

    public function list()
    {
        $user = Karyawan::where('nik', '=', Auth::user()->username)->first();

        
        $data = TrxRbHeader::where('CREATED_BY', $user->nik)
                ->where('BRANCH_ID', $user->branch_id)
                ->orderBy('created_date', 'DESC')
                ->paginate(10);
        
        return view('transaksi.pengajuan_riwayat', compact('data'));
    }

    public function simpan(Request $request)
    {
        foreach($request->file('dokumen') as $file)
        {

            $nama_ft = $request->no_rb. '-' .$file->getClientOriginalName();
            $file->move('dokumen', $nama_ft);

            $dok[] = [
                "RB_ID"         => $request->no_rb,
                "DOKUMEN_NAME"  => $nama_ft
            ];
        }
        $user  = Karyawan::where("nik", $request->nama)->first();
        

        foreach($request->addmore as $data){
            $detail = [
                'RB_ID'     => $request->no_rb,
                'ITEM'      => $data['keterangan'],
                'QTY'       => (int)$data['qty'],
                'HARGA'     => str_replace('.', '', $data['harga']),
                'ITEM_ID'   => $this->itemId(),
            ];
            TrxRbDetailItem::insert($detail);
        }
        // dd($detail);
        $tracking = [
            'rb_id'         => $request->no_rb,
            'status'        => 'Create RB',
            'id_user'       => $request->nama,
            'created_date'  => date('Y-m-d H:i:s')
        ];
        
        if($request->diketahui != ''){
            $header = [
                "RB_ID"        => $request->no_rb,
                "CREATED_BY"   => $request->nama,
                "KETERANGAN"   => $request->note,
                "STATUS"       => 1,
                "NAMA_REK"     => $request->anrek,
                "BANK"         => $request->bank,
                "NO_REK"       => (int)$request->rekening,
                "TOTAL_HARGA"  => str_replace('.', '', $request->total),
                "BRANCH_ID"    => $request->cabang,
                "SCHEMA_NAME"  => $user->schema,
                "RB_DATE"      => date('Y-m-d'),
                "CREATED_DATE" => date('Y-m-d H:i:s'),
                "CREATE_USER"  => $request->nama,
            ];
            
            $kacab = Karyawan::where("nik", $request->diketahui)->first();
            $data1 = [
                'kacab'     => $kacab->nama,
                'norb'      => $request->no_rb,
                'pelapor'   => $user->nama,
                'cabang'    => $user->cabang->branch_name
            ];
    
            \Mail::to($kacab->user->email)->send(new \App\Mail\NewTicketToKacab($data1));
            
            $approval = [
                'rb_id'         => $request->no_rb,
                'approve_by'    => $kacab->nik,
                'status'        => 0,
                'leveling'      => 1,
                'flag'          => 'MENGETAHUI',
                'approve_date'  => date('Y-m-d H:i:s'),
            ];
            TrxRbDetailApproval::insert($approval);
        }else{
            
            // langsung ke admin ho
            $cekuser = Karyawan::where("nik", $request->nama)->first();
            $email = [
                'to'            => 'Admin RB',
                'rb_id'         => $request->no_rb,
                'cabang'        => $cekuser->cabang->branch_name,
                'pemohon'       => $cekuser->nama
            ];
            \Mail::to('detriawanrayi@gmail.com')->send(new \App\Mail\NewTicketToAdminHo($email));
            $header = [
                "RB_ID"        => $request->no_rb,
                "CREATED_BY"   => $request->nama,
                "KETERANGAN"   => $request->note,
                "STATUS"       => 2,
                "NAMA_REK"     => $request->anrek,
                "BANK"         => $request->bank,
                "NO_REK"       => (int)$request->rekening,
                "TOTAL_HARGA"  => str_replace('.', '', $request->total),
                "BRANCH_ID"    => $request->cabang,
                "SCHEMA_NAME"  => $user->schema,
                "RB_DATE"      => date('Y-m-d'),
                "CREATED_DATE" => date('Y-m-d H:i:s'),
                "CREATE_USER"  => $request->nama,
            ];
        }

        $approval2 = [
            'rb_id'         => $request->no_rb,
            'approve_by'    => Auth::user()->username,
            'status'        => 1,
            'leveling'      => 0,
            'flag'          => 'MEMBUAT',
            'approve_date'  => date('Y-m-d H:i:s'),
        ];
        TrxRbDetailApproval::insert($approval2);

        TrxRbHeader::insert($header);
        TrxRbDetailDokumen::insert($dok);
        TrxRbTracking::insert($tracking);
        
        return redirect()->route('pengajuan.list')->with('message','RB Berhasil Disimpan!');
    }

    public function detail($id)
    {
        $data     = TrxRbHeader::where('RB_ID', $id)->first();
        $cek      = TrxRbDetailApproval::where('RB_ID', $id)
                    ->where('approve_by', Auth::user()->username)
                    ->where('status',0)->first();
        
        $tracking = TrxRbTracking::where('RB_id', $id)->orderBy('created_date', 'asc')->get();
        $user     = Karyawan::where('nik', '=', Auth::user()->username)->first();
        $mengetahui = TrxRbDetailApproval::where('RB_ID', $id)
                        ->where('FLAG','MENGETAHUI')
                        ->orderBy('leveling', 'asc')
                        ->get();
        // dd($mengetahui);
        $menyetujui = TrxRbDetailApproval::where('RB_ID', $id)
                        ->where('FLAG','MENYETUJUI')
                        ->orderBy('leveling', 'asc')
                        ->get();
        
        $diketahui = Karyawan::where('id_jabatan',2)->orWhere('id_bag_dept',8)->get();
        $disetujui = Karyawan::where('id_jabatan',2)->get();

        return view('transaksi.pengajuanDetail', compact('data','cek','tracking','user','mengetahui','menyetujui','diketahui','disetujui'));
    }
    public function itemId()
    {
        $q = TrxRbDetailItem::select(DB::raw('max(SUBSTR(TRX_RB_DETAIL_ITEM.ITEM_ID,13)) as ITEM_ID'))
            ->get();
        $year = substr(date('Y'), -2);
        if (count($q) != 0) {
            foreach ($q as $k) {
                $tmp = ((int)$k->item_id) + 1;
                
                $kd = 'ITM' . "-" . $year . "-". sprintf("%07s", $tmp);  
            }
        }
        else {
            $kd = 'ITM' . "-" . $year . "-". "-0000001";
        }

        return $kd;
    }
    public function getKodeRB($user)
    {
        $schema = $user->schema;
        $branch = $user->branch_id;
        $year = substr(date('Y'), -2);
        $kd = null;

        if ($schema == 'MITRA') {
            $q = TrxRbHeader::select(DB::raw('max(SUBSTR(TRX_RB_HEADER.RB_ID,21)) as rb_id'))
            ->where('branch_id',$branch)
            ->where('schema_name',$schema)
            ->get();
            
            if (count($q) != 0) {
                foreach ($q as $k) {
                    $tmp = ((int)$k->rb_id) + 1;
                    $kd = 'RB' . "-" . $year . "-". $schema . "-" . $branch . "-" . sprintf("%06s", $tmp);
                }
            }
            else {
                $kd = 'RB' . "-" . $year . "-". $schema ."-" . $branch . "-000001";
            }
            
            return $kd;
        } else if ($schema == 'SEHATI') {
            $q = TrxRbHeader::select(DB::raw('max(SUBSTR(TRX_RB_HEADER.RB_ID,22)) as rb_id'))
            ->where('branch_id',$branch)
            ->where('schema_name',$schema)
            ->get();
            
            if (count($q) != 0) {
                foreach ($q as $k) {
                    $tmp = ((int)$k->rb_id) + 1;
                    $kd = 'RB' . "-" . $year . "-". $schema . "-" . $branch . "-" . sprintf("%06s", $tmp);
                }
            }
            else {
                $kd = 'RB' . "-" . $year . "-". $schema ."-" . $branch . "-000001";
            }
            
            return $kd;
        } else if ($schema == 'JAYA' || $schema == 'MAJU') {
            $q = TrxRbHeader::select(DB::raw('max(SUBSTR(TRX_RB_HEADER.RB_ID,20)) as rb_id'))
            ->where('branch_id',$branch)
            ->where('schema_name',$schema)
            ->get();
            
            if (count($q) != 0) {
                foreach ($q as $k) {
                    $tmp = ((int)$k->rb_id) + 1;
                    $kd = 'RB' . "-" . $year . "-". $schema . "-" . $branch . "-" . sprintf("%06s", $tmp);
                }
            }
            else {
                $kd = 'RB' . "-" . $year . "-". $schema ."-" . $branch . "-000001";
            }
            
            return $kd;
        }

    }
}