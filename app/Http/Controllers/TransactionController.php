<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use File;
use DB; 
use Carbon\Carbon;
use App\Dokumen;
use App\Karyawan;
use App\Kategori;
use App\Kondisi;
use App\Tiket;
use App\Teknisi;
use App\Tracking;
use App\User;
use App\Rating;

class TransactionController extends Controller
{
    public function newticket(Request $request)
    {
        $user = Karyawan::where('nik','=', Auth::user()->username)->first();
        $kategori = Kategori::orderBy('created_at', 'ASC')->get();
        $kondisi = Kondisi::orderBy('created_at', 'ASC')->get();

        return view('transaksi.newticket', compact('user','kategori','kondisi'));
    }

    public static function _idTicket(){
        $q= Tiket::select(DB::raw('MAX(RIGHT(idTiket,4)) as idTiket'))->get();
       
        if($q)
        {
            foreach($q as $k)
            {
                $tmp = ((int)$k->idTiket)+1;
                $kd = "TKT".sprintf("%04s", $tmp);
            }
        }
        else
        {
            $kd = "TKT0001";
        }

        return $kd;
    }
    public function simpanTiketBaru(Request $request){
        $validator = Validator::make(
            $request->all(), [
                'foto.*'    => 'mimes:png,jpge,jpg,jpeg|max:2048',
                'file.*'    => 'mimes:csv,xls,xlsx,pdf,doc,docx|max:2048',
                'kategori'  => 'required',
                'kondisi'   => 'required',
                'subjek'    => 'required|min:5',
                'deskripsi' => 'required|min:5'
            ],[
                'foto.*.mimes'      => 'Foto harus berupa file dengan tipe: png, jpge, jpg, jpeg !',
                'foto.*.max'        => 'Maaf! Makimal besar foto: 2 MB.',

                'file.*.mimes'      => 'File harus berupa file dengan tipe: csv,xls,xlsx,pdf,doc,docx !',
                'file.*.max'        => 'Maaf! Makimal besar file: 2 MB.',

                'kategori.required' => 'Kategori tidak boleh kosong !',
                'kondisi.required' => 'Kondisi tidak boleh kosong !',
                
                'subjek.required'   => 'Subjek tidak boleh kosong !',
                'subjek.min'        => 'Subjek Minimal 5 Karakter !',

                'deskripsi.required'    => 'Deskripsi tidak boleh kosong !',
                'deskripsi.min'         => 'Deskripsi Minimal 5 Karakter !',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $idTicket = $this->_idTicket();
        $idDok = Carbon::now()->timestamp;
        if($request->file('foto')){

            foreach($request->file('foto') as $file)
            {
                $nama_ft = 'FT-'.$file->getClientOriginalName();
                $file->move('file_ticket', $nama_ft);
                $nama_foto[] = $nama_ft;
            }
            $foto = new Dokumen();
            $foto->idDokumen = 'FT-'.$idDok;
            $foto->file      = json_encode($nama_foto);
            $foto->save();
        }
        if($request->file('file')){

            foreach($request->file('file') as $file)
            {
    
                $nama_fl = 'FL-'.$file->getClientOriginalName();
                $file->move('file_ticket', $nama_fl);
                $nama_file[] = $nama_fl;
            }
            $foto = new Dokumen();
            $foto->idDokumen = 'FL-'.$idDok;
            $foto->file      = json_encode($nama_file);
            $foto->save();
        }

        $user = Karyawan::where('nik','=',Auth::user()->username)->first();
        $kondisi = Kondisi::where('id','=', $request->kondisi)->first();
        $data1 = [
            'idTiket'   => $idTicket,
            'pelapor'   => $user->nama,
            'cabang'    => $user->cabang->branch_name,
            'kondisi'   => $kondisi->nama_kondisi,
            'masalah'   => $request->subjek
        ];

        \Mail::to('rayidetriawan@gmail.com')->send(new \App\Mail\NewTicketToAdmin($data1));
        
        $data = new Tiket();
        $data->reported         = Auth::user()->username;
        $data->idTiket          = $idTicket;
        $data->id_kategori      = $request->kategori;
        $data->id_kondisi       = $request->kondisi;
        $data->id_teknisi       = '';
        $data->subjek_masalah   = $request->subjek;
        $data->deskripsi_masalah= $request->deskripsi;
        $data->foto             = ($request->file('foto')) ? 'FT-'.$idDok : '';
        $data->file             = ($request->file('file')) ? 'FL-'.$idDok : '';
        $data->status           = '1';
        $data->progress         = 0;
        $data->tgl_proses       = date('Y-m-d');
        $data->save();

        $track = new Tracking();
        $track->id_ticket   = $idTicket;
        $track->status      = 'Created Ticket';
        $track->deskripsi   = '';
        $track->id_user     = Auth::user()->username;
        $track->save();

        return redirect()->route('newticket')->with('message', 'Tiket berhasil ditambah !');
    }

    public function myticket(Request $request){
        $data = Tiket::where('reported','=', Auth::user()->username)->paginate(10);
        
        return view('transaksi.myticket', compact('data'));
    }
    
    public function detailticket($id){
        // dd($id);
        $data       = Tiket::where('idTiket','=', $id)->first();
        $tracking   = Tracking::where('id_ticket','=', $id)->paginate(20);
        $user       = Karyawan::where('nik','=', $data->reported)->first();

        $cektiket = Tiket::where('reported','=', Auth::user()->username)
                                ->where('status','=', 0)
                                ->first();
        $cekreview= null;
        if($cektiket){
            //cek apakah sudah ada penilaian ?
            $cekrating = Rating::where('id_ticket', '=', $cektiket->idTiket)->first();
            if(empty($cekrating)){
                $cekreview = Tiket::where('idTiket','=',$cektiket->idTiket)->first();
            }
        }
        
        return view('transaksi.datailticket', compact('data','user','tracking','cekreview'));
    }
    public function listticket(Request $request){
        $data = Tiket::where('status', '!=','1')->paginate(10); // setelah ticket di approve -> assigment/ detail
        
        return view('transaksi.listticket', compact('data'));
    }
    public function approvalticket(Request $request){
        $data = Tiket::where('status','=','1')->paginate(10); // approval ticket svp
        $teknisi = Teknisi::all();
        $kategori = Kategori::all();
        
        return view('transaksi.approvalticket', compact('data','teknisi','kategori'));
    }

    public function updateStatus(Request $request){
        
        if($request->aksi == 'komentar'){
            $validate = $request->validate([
                'komentar'              => 'required|max:150|min:2',
            ],[
                'komentar.required'  => 'Bidang ini tidak boleh kosong !',
                'komentar.max'       => 'Maksimal 150 Karakter!',
                'komentar.min'       => 'Minimal 2 Karakter!',
            ]);

            //update ke tabel tracking
            $treking = [
                'id_ticket' => $request->idTiket,
                'status'    => 'Tiket Dikomentari',
                'deskripsi' => $request->komentar,
                'id_user'   => Auth::user()->username,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            //create
            Tracking::insert($treking);

            return redirect()->route('detail.ticket',$request->idTiket)->with('message','Berhasil Memberikan Komentar!');
        }

        if($request->aksi == 'tolaktiket')
        {
            $validate = $request->validate([
                'alasantolak'      => 'required|max:150|min:2',
            ],[
                'alasantolak.required'  => 'Bidang ini tidak boleh kosong !',
                'alasantolak.max'       => 'Maksimal 150 Karakter!',
                'alasantolak.min'       => 'Minimal 2 Karakter!',
            ]);

            //update ke tabel tiket dan tracking
            $dtiket = [
                'status'     => 5,
                'progress'   => 100,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            // Kirim email ke user bahwa tiket ditolak
            $tiket = Tiket::where('idTiket','=',$request->id)->first();
            $data = [
                'user'      => $tiket->karyawan->nama,
                'id_tiket'  => $request->id,
                'subjek'    => $tiket->subjek_masalah,
                'status'    => 'Tiket Ditolak',
                'deskripsi' => $request->alasantolak,
                'updated_at' => date('Y-m-d H:i:s')
            ];
            
            \Mail::to($tiket->user->email)->send(new \App\Mail\TicketDitolak($data));
            //update
            Tiket::where('idTiket', $request->id)->update($dtiket);

            $treking = [
                'id_ticket' => $request->id,
                'status'    => 'Tiket Ditolak',
                'deskripsi' => $request->alasantolak,
                'id_user'   => Auth::user()->username,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            //create
            Tracking::insert($treking);

            return redirect()->route('list.ticket')->with('message','Tiket '.$request->id.' Berhasil Ditolak!');
        }

        if($request->aksi == 'tugaskan_teknisi')
        {
            // dd($request);
            $validate = $request->validate([
                'teknisi'      => 'required',
            ],[
                'teknisi.required'  => 'Bidang ini tidak boleh kosong !',
            ]);
            //update
            $dtiket = [
                'status'     => 3,
                'id_teknisi' => $request->teknisi,
                'updated_at' => date('Y-m-d H:i:s')
            ];
            
            Tiket::where('idTiket', $request->id)->update($dtiket);
            //kirim email ke teknisi
            $teknisi = Teknisi::where('nik','=',$request->teknisi)->first();
            
            $data = [
                'user'      => $teknisi->karyawan->nama,
                'id_tiket'  => $request->id,
                'updated_at' => date('Y-m-d H:i:s')
            ];
            
            
            $treking = [
                'id_ticket' => $request->id,
                'status'    => 'Teknisi Telah ditugaskan',
                'deskripsi' => 'Menunggu Approval Teknisi Terkait',
                'id_user'   => Auth::user()->username,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            //create
            Tracking::insert($treking);
            \Mail::to($teknisi->user->email)->send(new \App\Mail\NewTicketToTeknisi($data));

            return redirect()->route('list.ticket')->with('message','Berhasil menugaskan teknisi!');
        }

        if($request->aksi == 'update_progress'){
            
            $validate = $request->validate([
                'komentar'      => 'required|max:150|min:2',
                'progress'      => 'required',
            ],[
                'progress.required'  => 'Bidang ini tidak boleh kosong !',
                'komentar.required'  => 'Bidang ini tidak boleh kosong !',
                'komentar.max'       => 'Maksimal 150 Karakter!',
                'komentar.min'       => 'Minimal 2 Karakter!',
            ]);

            //update ke tabel tiket dan tracking
            $dtiket = [
                'status'     => ($request->progress < 100) ? 4 : 0,
                'progress'   => $request->progress,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            //update
            Tiket::where('idTiket', $request->idTiket)->update($dtiket);

            $treking = [
                'id_ticket' => $request->idTiket,
                'status'    => ($request->progress < 100) ? 'Tiket sedang dikerjakan' : 'Tiket solved',
                'deskripsi' => $request->komentar,
                'id_user'   => Auth::user()->username,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            //create
            Tracking::insert($treking);

            return redirect()->route('detail.ticket.teknisi',$request->idTiket)->with('message','Tiket Berhasil Diupdate!');
        }
    }
    public function getSpesialis($id){
        $data = Teknisi::with('karyawan')->where('id_kategori', '=', $id)->get();

        return response()->json($data);
    }

    public function assigmentTicket(){
        $data = Tiket::where('id_teknisi', '=', Auth::user()->username)->paginate(10);
        
        return view('transaksi.assigmentticket', compact('data'));
    }

    public function detailticketteknisi($id){
        $data       = Tiket::where('idTiket','=', $id)->first();
        $tracking   = Tracking::where('id_ticket','=', $id)->paginate(20);
        $user       = Karyawan::where('nik','=', $data->reported)->first();
        
        return view('transaksi.datailticketteknisi', compact('data','user','tracking'));
    }
}
