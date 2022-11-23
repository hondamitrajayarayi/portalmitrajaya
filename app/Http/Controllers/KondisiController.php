<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kondisi;

class KondisiController extends Controller
{
    public function index()
    {
        $data = Kondisi::paginate(3);

        return view('master.kondisi', compact('data'));
    }

    public function simpan(Request $request)
    {
        $validate = $request->validate([
            'nama_kondisi' => 'required|max:50|min:2',
            'waktu_respon' => 'required|max:1',
        ],
        [
            'nama_kondisi.required' => 'Bidang ini tidak boleh kosong !',
            'nama_kondisi.max' => 'Maksimal 50 Karakter!',
            'nama_kondisi.min' => 'Minimal 2 Karakter!',

            'waktu_respon.required' => 'Bidang ini tidak boleh kosong!',
            'waktu_respon.max' => 'Maksimal 1 Karakter!',
        ]);

        $data = [
            'nama_kondisi' => $request->nama_kondisi,
            'waktu_respon' => $request->waktu_respon,
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        Kondisi::insert($data);

        return redirect()->route('kondisi')->with('message','Data Berhasil Disimpan!');
    }

    public function edit($id)
    {
		$kondisi = Kondisi::where('id', $id)->first();

        
		return response()->json($kondisi);

    }

    public function update(Request $request)
    {
        $validate = $request->validate([
            'edit_nama_kondisi' => 'required|max:50|min:2',
            'edit_waktu_respon' => 'required|max:1',
        ],
        [
            'edit_nama_kondisi.required' => 'Bidang ini tidak boleh kosong !',
            'edit_nama_kondisi.max' => 'Maksimal 50 Karakter!',
            'edit_nama_kondisi.min' => 'Minimal 2 Karakter!',

            'edit_waktu_respon.required' => 'Bidang ini tidak boleh kosong!',
            'edit_waktu_respon.max' => 'Maksimal 1 Karakter!',
        ]);
        $data = [
            'nama_kondisi' => $request->edit_nama_kondisi,
            'waktu_respon' => $request->edit_waktu_respon,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        Kondisi::where('id', $request->id)->update($data);

        return redirect()->route('kondisi')->with('message','Data Berhasil Diubah!');
    }

    public function hapus($id)
    {
        Kondisi::where('id', $id)->delete();

        return redirect()->back()->with('message','Data Berhasil Dihapus!');
    }
}
