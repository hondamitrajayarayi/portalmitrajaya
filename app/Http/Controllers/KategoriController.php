<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;

class KategoriController extends Controller
{
    public function index()
    {
        $data = Kategori::paginate(3);

        return view('master.kategori', compact('data'));
    }

    public function simpan(Request $request)
    {
        $validate = $request->validate([
            'nama_kategori' => 'required|max:50|min:2'
        ],
        [
            'nama_kategori.required' => 'Bidang ini tidak boleh kosong !',
            'nama_kategori.max' => 'Maksimal 50 Karakter!',
            'nama_kategori.min' => 'Minimal 2 Karakter!',
        ]);

        $data = [
            'nama_kategori' => $request->nama_kategori,
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        Kategori::insert($data);

        return redirect()->route('kategori')->with('message','Data Berhasil Disimpan!');
    }

    public function edit($id)
    {
		$kategori = Kategori::where('id', $id)->first();

        
		return response()->json($kategori);

    }

    public function update(Request $request)
    {
        $validate = $request->validate([
            'edit_nama_kategori' => 'required|max:50|min:2'
        ],
        [
            'edit_nama_kategori.required' => 'Bidang ini tidak boleh kosong !',
            'edit_nama_kategori.max' => 'Maksimal 50 Karakter!',
            'edit_nama_kategori.min' => 'Minimal 2 Karakter!',
        ]);

        $data = [
            'nama_kategori' => $request->edit_nama_kategori,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        Kategori::where('id', $request->id)->update($data);

        return redirect()->route('kategori')->with('message','Data Berhasil Diubah!');
    }

    public function hapus($id)
    {
        Kategori::where('id', $id)->delete();

        return redirect()->back()->with('message','Data Berhasil Dihapus!');
    }
}
