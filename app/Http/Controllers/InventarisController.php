<?php

namespace App\Http\Controllers;

use App\Branch;
use App\GrupInventaris;
use App\JenisInventaris;
use App\Karyawan;
use App\MstQrInventory;
use App\TrxInventory;
use App\TrxPeminjaman;
use App\TrxPeminjamanItem;
use App\TrxRbDetailApproval;
use App\TrxRbDetailItem;
use App\TrxRbHeader;
use App\TrxRbTracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InventarisController extends Controller
{
    public function index()
    {
        $datai = TrxInventory::orderBy('created_date','desc')->paginate(10);

        return view('inventori.index', compact('datai'));
    }
    public function tambah()
    {
        $data = TrxRbHeader::where('trx_rb_header.status',0)
                ->whereNotIn('trx_rb_detail_item.item_id', TrxInventory::get('item_id'))
                ->join('trx_rb_detail_item','trx_rb_detail_item.rb_id','=','trx_rb_header.rb_id')
                ->orderBy('trx_rb_header.created_date','desc')
                ->get();
        $autofill = null;
        $grup = GrupInventaris::get(["group_name", "group_id"]);
        
        
        return view('inventori.inventory_tambah', compact('data','autofill','grup'));
    }
    public function peminjaman()
    {
        $datai = TrxPeminjaman::orderBy('status', 'desc')
                ->orderBy('created_date','desc')
                ->paginate(10);

        return view('inventori.peminjaman', compact('datai'));
    }
    public function tambahpeminjaman()
    {
        $data = Branch::all();
        // $data = TrxInventory::where('status',1)->orderBy('created_date','desc')
        //         ->get();

        return view('inventori.peminjaman_tambah', compact('data'));
    }
    public function simpanpeminjaman(Request $request)
    {
        $validate = $request->validate([
            'item' => 'required'
        ]);
        $user = Karyawan::where('nik', Auth::user()->username)->first();
        $id_peminjaman =$this->get_idpinjam($user);
        // dd(date('Y-m-d H:i:s', strtotime($request['estimasi'])));
        $data = [
            'V_ID_PINJAM'         => $id_peminjaman,
            'V_ID_INVENTARIS'     => null,
            'V_NAMA_PEMINJAM'     => $request['nama_peminjam'],
            'V_TGL_PINJAM'        => date('Y-m-d H:i:s'),
            'V_TGL_BALIK'         => null,
            'V_KET'               => $request['keterangan'],
            'V_CREATED_BY'        => Auth::user()->username,
            'V_CREATE_DATE'       => date('Y-m-d H:i:s'),
            'V_UPDATED_DATE'      => null,
            'V_DIVISI_PEMINJAM'   => $request['divisi_peminjam'],
            'V_ESTIMASI_BALIK'    => date('Y-m-d H:i:s', strtotime($request['estimasi']))
        ];
        
        // test prosedur
        $result = DB::connection('INTRA')->executeProcedure("INTRAMITRA.SP_IN_TRX_PEMINJAMAN", $data);   
        
        foreach($request['item'] as $item){
            $data1[] = [
                'ID_PEMINJAMAN'  => $id_peminjaman,
                'ID_INVENTORY'   => $item,
                'CREATED_DATE'   => date('Y-m-d H:i:s'),
                'UPDATED_DATE'   => null
            ];
            $inventory = [
                'status'    => 0
            ];
            TrxInventory::where('inventory_id',$item)->update($inventory);
        }
        TrxPeminjamanItem::insert($data1);

        
        return redirect()->route('inventaris.peminjaman')->with('message','Data Berhasil Disimpan!');
    }
    public function updatepeminjaman(Request $request)
    {
        // dd($request);
        $data = [
            'note'          => $request->note,
            'status'        => 0,
            'tgl_balik'     => date('Y-m-d H:i:s'),
            'updated_date'  => date('Y-m-d H:i:s'), 
        ];
        TrxPeminjaman::where('id_pinjam', $request->id_pinjam)
            ->update($data);
        
        $inventory = [
            'status'    => 1
        ];
        $data = TrxPeminjamanItem::where('id_peminjaman',$request->id_pinjam)->get('id_inventory');
        
        TrxInventory::whereIn('inventory_id',$data)->update($inventory);
        return redirect()->route('inventaris.peminjaman')->with('message','Data Berhasil Diupdate!');
    }
    public function editpeminjaman($id)
    {
        $data = TrxPeminjamanItem::where('id_peminjaman', $id)
                ->get();
        foreach ($data as  $value) {
            $id_inventory[] = $value->id_inventory;
        }
        $data1 = TrxInventory::whereIn('inventory_id', $id_inventory)->get();
        
        return response()->json($data1);
    }
    public function get_idpinjam($user){
        $schema = $user->schema;
        $branch = $user->branch_id;
        $year = substr(date('Y'), -2);
        $kd = null;
        
        if ($schema == 'MITRA') {
            $q = TrxPeminjaman::select(DB::raw('max(SUBSTR(TRX_PEMINJAMAN.ID_PINJAM,23)) as ID_PINJAM'))
            ->get();
            
            if (count($q) != 0) {
                foreach ($q as $k) {
                    $tmp = ((int)$k->id_pinjam) + 1;
                    
                    $kd = 'PNJ' . "-" . $year . "-". $schema . "-" . $branch . "-" . sprintf("%06s", $tmp);
                }
            }
            else {
                $kd = 'PNJ' . "-" . $year . "-". $schema ."-" . $branch . "-000001";
            }
        } else if ($schema == 'SEHATI') {
            $q = TrxPeminjaman::select(DB::raw('max(SUBSTR(TRX_PEMINJAMAN.ID_PINJAM,24)) as ID_PINJAM'))
            ->get();
            
            if (count($q) != 0) {
                foreach ($q as $k) {
                    $tmp = ((int)$k->id_pinjam) + 1;
                    
                    $kd = 'PNJ' . "-" . $year . "-". $schema . "-" . $branch . "-" . sprintf("%06s", $tmp);
                }
            }
            else {
                $kd = 'PNJ' . "-" . $year . "-". $schema ."-" . $branch . "-000001";
            }
        } else if($schema == 'JAYA' || $schema == 'MAJU'){
            $q = TrxPeminjaman::select(DB::raw('max(SUBSTR(TRX_PEMINJAMAN.ID_PINJAM,22)) as ID_PINJAM'))
            ->get();
            
            if (count($q) != 0) {
                foreach ($q as $k) {
                    $tmp = ((int)$k->id_pinjam) + 1;
                    
                    $kd = 'PNJ' . "-" . $year . "-". $schema . "-" . $branch . "-" . sprintf("%06s", $tmp);
                }
            }
            else {
                $kd = 'PNJ' . "-" . $year . "-". $schema ."-" . $branch . "-000001";
            }
        }

        return $kd;
    }
    public function jenis(Request $request)
    {
        $data['jenis'] = JenisInventaris::where("group_id", $request->grup_id)
                            ->get(["nama_jenis", "jenis_id"]);
  
        return response()->json($data);
    }
    public function simpan(Request $request)
    {   
        
        if (!empty($request->norb)) {
            $rb          = TrxRbHeader::where('rb_id', $request->norb)->first();
            $user        = Karyawan::where('nik', '=', $rb->create_user)->first();
            $inventoryId = $this->getKode($user);
            $file        = $request->file('gambar');
            $gambar      = $inventoryId. '-' .$file->getClientOriginalName();
            $file->move('inventory/gambar', $gambar);

            $data = [
                'INVENTORY_ID'  => $inventoryId,
                'RB_ID'         => $request->norb,
                'STATUS'        => 1,
                'ITEM'          => $request->item,
                'ITEM_ID'       => $request->item_id,
                'QTY'           => $request->qty,
                'HARGA_BELI'    => preg_replace("/[^0-9]/", '', $request->harga),
                'CREATED_BY'    => Auth::user()->username,
                'CREATED_DATE'  => date('Y-m-d H:i:s'),
                'UPDATED_DATE'  => null,
                'BRANCH_ID'     => $rb->branch_id,
                'SCHEMA'        => $rb->schema_name,
                'DESKRIPSI_ITEM'=> $request->deskripsi,
                'IMAGE'         => $gambar,
                'GRUP_ID'       => $request->grup,
                'JENIS_ID'      => $request->jenis,
            ];
        }else{
            // create item id
            $user        = Karyawan::where('nik', '=', Auth::user()->username)->first();
            $inventoryId = $this->getKode($user);
            $file        = $request->file('gambar');
            $gambar      = $inventoryId. '-' .$file->getClientOriginalName();
            $file->move('inventory/gambar', $gambar);
            $data = [
                'INVENTORY_ID'  => $inventoryId,
                'STATUS'        => 1,
                'ITEM'          => $request->item,
                'QTY'           => $request->qty,
                'HARGA_BELI'    => preg_replace("/[^0-9]/", '', $request->harga),
                'CREATED_BY'    => Auth::user()->username,
                'CREATED_DATE'  => date('Y-m-d H:i:s'),
                'UPDATED_DATE'  => null,
                'BRANCH_ID'     => $user->branch_id,
                'SCHEMA'        => $user->schema,
                'DESKRIPSI_ITEM'=> $request->deskripsi,
                'IMAGE'         => $gambar,
                'GRUP_ID'       => $request->grup,
                'JENIS_ID'      => $request->jenis,
            ];
        }
        
        TrxInventory::insert($data);
        
        return redirect()->route('inventaris')->with('message','Data Berhasil Disimpan!');
    }
    public function pilihrb (Request $request){
        
        $validate = $request->validate([
            'item' => 'required'
        ]);

        $data = TrxRbHeader::where('trx_rb_header.status',0)
                ->whereNotIn('trx_rb_detail_item.item_id', TrxInventory::get('item_id'))
                ->join('trx_rb_detail_item','trx_rb_detail_item.rb_id','=','trx_rb_header.rb_id')
                ->orderBy('trx_rb_header.created_date','desc')
                ->get();
        $autofill = TrxRbDetailItem::where('item_id', $request->item)->first();
        $grup = GrupInventaris::get(["group_name", "group_id"]);
        return view('inventori.inventory_tambah', compact('data','autofill','grup'));
    }
    public function generateqr(Request $request)
    {
        $validate = $request->validate([
            'inventory' => 'required'
        ]);

        foreach ($request->inventory as $value) {
            $cek = MstQrInventory::where('inventory_id', $value)->count();

            if($cek == 0){
                //generate qr
                \QrCode::size(250)
                    ->format('svg')
                    ->generate('http://intranet.hondamitrajaya.com/inventaris/getinfo/'.$value, public_path('inventory/qr/qr-'.$value.'.svg'));

                //simpan ke tabel mst qr
                $inventory = [
                    'INVENTORY_ID'  => $value,
                    'URL'           => 'http://intranet.hondamitrajaya.com/inventaris/getinfo/'.$value,
                    'NAME_FILE'     => 'qr-'.$value.'.svg',
                    'CREATED_BY'    => Auth::user()->username,
                    'CREATED_DATE'  => date('Y-m-d H:i:s')
                ];

                MstQrInventory::insert($inventory);
            }
        }

        // menampilkan data sesuai request
        $data = MstQrInventory::whereIn('inventory_id', $request->inventory)
            ->orderBy('created_date','desc')
            ->get();
        
        // return ke view print qr
        return view('inventori.previewprint', compact('data'));
    }
    
    public function getinfo($id)
    {
        // inventaris
        $inventaris = TrxInventory::where('inventory_id', $id)->first();
        $rb_id = $inventaris->rb_id;
        
        if(!empty($rb_id)){

            $tracking = TrxRbTracking::where('RB_id', $rb_id)->orderBy('created_date', 'asc')->get();
            $user     = Karyawan::where('nik', '=', $inventaris->TrxRbHeader->created_by)->first();
            $mengetahui = TrxRbDetailApproval::where('RB_ID', $rb_id)
                            ->where('FLAG','MENGETAHUI')
                            ->orderBy('approve_date', 'asc')
                            ->get();
            // dd($mengetahui);
            $menyetujui = TrxRbDetailApproval::where('RB_ID', $rb_id)
                            ->where('FLAG','MENYETUJUI')
                            ->orderBy('approve_date', 'asc')
                            ->get();
            
            $diketahui = Karyawan::where('id_jabatan',2)->orWhere('id_bag_dept',8)->get();
            $disetujui = Karyawan::where('id_jabatan',2)->get();
        }else{
            $tracking = null;
            $user = null;
            $mengetahui = null;
            $menyetujui = null;
            $diketahui = null;
            $disetujui = null; 
            
        }

        $peminjaman1 = TrxPeminjamanItem::where('id_inventory', $id)->first();
        if (!empty($peminjaman1)) {
            # code...
            $peminjaman = TrxPeminjamanItem::where('id_inventory', $id)
                        ->orderBy('created_date', 'desc')
                        ->paginate(10);
        }else{
            $peminjaman = null;
        }

        $data     = TrxRbHeader::where('RB_ID', $rb_id)->first();

        return view('inventori.inventory_detail', compact('inventaris','id','data','tracking','user','mengetahui','menyetujui','diketahui','disetujui','peminjaman'));
    }
    public function getKode($user)
    {
        $schema = $user->schema;
        $branch = $user->branch_id;
        $year = substr(date('Y'), -2);
        $kd = null;
        
        if ($schema == 'MITRA') {
            $q = TrxInventory::select(DB::raw('max(SUBSTR(TRX_INVENTORY.INVENTORY_ID,22)) as INVENTORY_ID'))
            ->where('schema',$schema)
            ->where('branch_id',$branch)
            ->get();
            
            if (count($q) != 0) {
                foreach ($q as $k) {
                    $tmp = ((int)$k->inventory_id) + 1;
                    
                    $kd = 'IV' . "-" . $year . "-". $schema . "-" . $branch . "-" . sprintf("%06s", $tmp);
                }
            }
            else {
                $kd = 'IV' . "-" . $year . "-". $schema ."-" . $branch . "-000001";
            }
        } else if($schema == 'SEHATI'){
            $q = TrxInventory::select(DB::raw('max(SUBSTR(TRX_INVENTORY.INVENTORY_ID,23)) as INVENTORY_ID'))
            ->where('schema',$schema)
            ->where('branch_id',$branch)
            ->get();

            if (count($q) != 0) {
                foreach ($q as $k) {
                    $tmp = ((int)$k->inventory_id) + 1;
                    
                    $kd = 'IV' . "-" . $year . "-". $schema . "-" . $branch . "-" . sprintf("%06s", $tmp);
                }
            }
            else {
                $kd = 'IV' . "-" . $year . "-". $schema ."-" . $branch . "-000001";
            }
        } else if($schema == 'JAYA' || $schema == 'MAJU'){
            $q = TrxInventory::select(DB::raw('max(SUBSTR(TRX_INVENTORY.INVENTORY_ID,21)) as INVENTORY_ID'))
            ->where('schema',$schema)
            ->where('branch_id',$branch)
            ->get();
            
            if (count($q) != 0) {
                foreach ($q as $k) {
                    $tmp = ((int)$k->inventory_id) + 1;
                    
                    $kd = 'IV' . "-" . $year . "-". $schema . "-" . $branch . "-" . sprintf("%06s", $tmp);
                }
            }
            else {
                $kd = 'IV' . "-" . $year . "-". $schema ."-" . $branch . "-000001";
            }
        }
        
        return $kd;
    }
}
