<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubKategori;
use App\Kategori;

class SubKategoriController extends Controller
{
    public function index()
    {
        $data = SubKategori::paginate(4);
        $kategori = Kategori::orderBy('created_at', 'ASC')->get();

        return view('master.subkategori', compact('data','kategori'));
    }

    public function simpan(Request $request)
    {
        $validate = $request->validate([
            'id_kategori' => 'required',
            'nama_sub_kategori' => 'required|max:100|min:2'
        ],
        [
            'id_kategori.required' => 'Bidang ini tidak boleh kosong !',
            'nama_sub_kategori.required' => 'Bidang ini tidak boleh kosong !',
            'nama_sub_kategori.max' => 'Maksimal 100 Karakter!',
            'nama_sub_kategori.min' => 'Minimal 2 Karakter!',
        ]);

        $data = [
            'nama_sub_kategori' => $request->nama_sub_kategori,
            'id_kategori'=> $request->id_kategori,
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        SubKategori::insert($data);

        return redirect()->route('subkategori')->with('message','Data Berhasil Disimpan!');
    }

    public function edit($id)
    {
		$kategori = SubKategori::where('id', $id)->first();

        
		return response()->json($kategori);

    }

    public function update(Request $request)
    {
        // dd($request);
        $validate = $request->validate([
            'edit_nama_sub_kategori' => 'required|max:50|min:2',
            'edit_id_kategori' => 'required'
        ],
        [
            'edit_id_kategori.required' => 'Bidang ini tidak boleh kosong !',
            'edit_nama_sub_kategori.required' => 'Bidang ini tidak boleh kosong !',
            'edit_nama_sub_kategori.max' => 'Maksimal 50 Karakter!',
            'edit_nama_sub_kategori.min' => 'Minimal 2 Karakter!',
        ]);

        $data = [
            'nama_sub_kategori' => $request->edit_nama_sub_kategori,
            'id_kategori' => $request->edit_id_kategori,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        SubKategori::where('id', $request->id)->update($data);

        return redirect()->route('subkategori')->with('message','Data Berhasil Diubah!');
    }

    public function hapus($id)
    {
        SubKategori::where('id', $id)->delete();

        return redirect()->back()->with('message','Data Berhasil Dihapus!');
    }
}
