<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jabatan;

class JabatanController extends Controller
{
    public function index()
    {
        
        $data = Jabatan::paginate(10); 
        return view('master.jabatan', compact('data'));
    }

    public function simpan(Request $request){
       
        $validate = $request->validate([
            'nama_jabatan' => 'required|min:2',
        ],
        [
            'nama_jabatan.required'      => 'Bidang ini tidak boleh kosong !',
            'nama_jabatan.min' => 'Minimal 2 Karakter!',
        ]);

        $data = [
            'nama_jabatan'  => $request->nama_jabatan,
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at' => date('Y-m-d H:i:s')
        ];

        Jabatan::insert($data);

        return redirect()->route('jabatan')->with('message','Data Berhasil Disimpan!');
    }

    public function edit($id)
    {
        $data = Jabatan::where('id', '=', $id)->first();

        return response()->json($data);
    }

    public function update(Request $request)
    {

       
        $validate = $request->validate([
            'edit_nama' => 'required|min:2',
        ],
        [
            'edit_nama.required'      => 'Bidang ini tidak boleh kosong !',
            'edit_nama.min' => 'Minimal 2 Karakter!',
        ]);

        $data = [
            'nama_jabatan'  => $request->edit_nama,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        
        Jabatan::where('id', $request->id)->update($data);

        return redirect()->route('jabatan')->with('message','Data Berhasil Diubah!');

    }

    public function hapus($id)
    {
        Jabatan::where('id', $id)->delete();

        return redirect()->back()->with('message','Data Berhasil Dihapus!');
    }
}
