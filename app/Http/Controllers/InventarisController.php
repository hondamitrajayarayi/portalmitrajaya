<?php

namespace App\Http\Controllers;

use App\GrupInventaris;
use App\JenisInventaris;
use App\Karyawan;
use App\MstQrInventory;
use App\TrxInventory;
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
        
        $data = TrxRbHeader::where('trx_rb_header.status',0)
                ->whereNotIn('trx_rb_detail_item.item_id', TrxInventory::get('item_id'))
                ->join('trx_rb_detail_item','trx_rb_detail_item.rb_id','=','trx_rb_header.rb_id')
                ->orderBy('trx_rb_header.created_date','desc')
                ->get();
        $datai = TrxInventory::orderBy('created_date','desc')->paginate(10);

        return view('inventori.index', compact('data','datai'));
    }
    public function tambah(){
        $data = TrxRbHeader::where('trx_rb_header.status',0)
                ->whereNotIn('trx_rb_detail_item.item_id', TrxInventory::get('item_id'))
                ->join('trx_rb_detail_item','trx_rb_detail_item.rb_id','=','trx_rb_header.rb_id')
                ->orderBy('trx_rb_header.created_date','desc')
                ->get();
        $autofill = null;
        $grup = GrupInventaris::get(["group_name", "group_id"]);
        
        
        return view('inventori.inventory_tambah', compact('data','autofill','grup'));
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
       
        // rb
        $rb_id = $inventaris->rb_id;
        
        $data     = TrxRbHeader::where('RB_ID', $rb_id)->first();
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

        return view('inventori.inventory_detail', compact('inventaris','id','data','tracking','user','mengetahui','menyetujui','diketahui','disetujui'));
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
