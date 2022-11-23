<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Branch;

class BranchController extends Controller
{
    public function index()
    {
        
        $data = Branch::orderBy('branch_name', 'ASC')->paginate(10);
        
        return view('master.branch', compact('data'));
    }

    public function simpan(Request $request){
       
        $validate = $request->validate([
            'nama_branch' => 'required|min:2',
        ],
        [
            'nama_branch.required'  => 'Bidang ini tidak boleh kosong !',
            'nama_branch.min'       => 'Minimal 2 Karakter!',
        ]);

    
        
        $data = [
            'branch_name'=> $request->nama_branch,
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at' => date('Y-m-d H:i:s')
        ];

        Branch::insert($data);

        return redirect()->route('branch')->with('message','Data Berhasil Disimpan!');
    }

    public function edit($id)
    {
        $data = Branch::where('id', '=', $id)->first();

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
            'branch_name'  => $request->edit_nama,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        
        Branch::where('id', $request->id)->update($data);

        return redirect()->route('branch')->with('message','Data Berhasil Diubah!');

    }

    public function hapus($id)
    {
        Branch::where('id', $id)->delete();

        return redirect()->back()->with('message','Data Berhasil Dihapus!');
    }
}
