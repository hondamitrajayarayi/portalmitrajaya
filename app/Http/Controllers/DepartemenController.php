<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departemen;

class DepartemenController extends Controller
{
    public function index()
    {
        
        $data = Departemen::paginate(10); 
        return view('master.departemen', compact('data'));
    }

    public function simpan(Request $request){
       
        $validate = $request->validate([
            'nama_dep' => 'required|min:2',
        ],
        [
            'nama_dep.required'      => 'Bidang ini tidak boleh kosong !',
            'nama_dep.min' => 'Minimal 2 Karakter!',
        ]);

    
        
        $data = [
            'nama_dept'      => $request->nama_dep,
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at' => date('Y-m-d H:i:s')
        ];

        Departemen::insert($data);

        return redirect()->route('departemen')->with('message','Data Berhasil Disimpan!');
    }

    public function edit($id)
    {
        $data = Departemen::where('id', '=', $id)->first();

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
            'nama_dept'  => $request->edit_nama,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        
        Departemen::where('id', $request->id)->update($data);

        return redirect()->route('departemen')->with('message','Data Berhasil Diubah!');

    }

    public function hapus($id)
    {
        Departemen::where('id', $id)->delete();

        return redirect()->back()->with('message','Data Berhasil Dihapus!');
    }
}
