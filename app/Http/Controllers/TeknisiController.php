<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teknisi;
use App\Kategori;
use App\User;

class TeknisiController extends Controller
{
    public function index()
    {
        $teknisi    = User::where('role','=','teknisi')->get();
        $kategori   = Kategori::all();
        $data       = Teknisi::paginate(10); 
        return view('master.teknisi', compact('data','teknisi','kategori'));
    }

    public function simpan(Request $request){
        
        $validate = $request->validate([
            'teknisi' => 'required',
            'kategori' => 'required',
        ],
        [
            'teknisi.required'      => 'Teknisi tidak boleh kosong !',
            'kategori.required'      => 'Spesialis tidak boleh kosong !',
            
        ]);

        $cek = Teknisi::where('nik', '=', $request->teknisi)->first();
        if($cek){
            return redirect()->route('teknisi')->with('message','Teknisi Sudah Ada!');
        }
    
        $data = [
            'nik'           => $request->teknisi,
            'id_kategori'   => $request->kategori,
            'status'        => '1',
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at' => date('Y-m-d H:i:s')
        ];

        Teknisi::insert($data);

        return redirect()->route('teknisi')->with('message','Data Berhasil Disimpan!');
    }


    public function update(Request $request)
    {
        if($request->status == '1'){
            $status = 0;
        }

        if ($request->status == '0') {
            $status = 1;
        } 
        
        $data = [
            'status'  => $status,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        Teknisi::where('id', $request->id)->update($data);
        
        return response()->json([
            'success' => true,
        ]); 

    }

    public function hapus($id)
    {
        Teknisi::where('id', $id)->delete();

        return redirect()->back()->with('message','Data Berhasil Dihapus!');
    }
}
