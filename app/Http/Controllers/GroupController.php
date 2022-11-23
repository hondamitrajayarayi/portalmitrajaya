<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Auth_group;
use App\Auth_permission;
use App\Auth_group_permission;

class GroupController extends Controller
{
    public function index()
    {
        
        $data = Auth_group::paginate(10);
        $menu = Auth_permission::all();

        return view('master.group', compact('data','menu'));
    }

    public function simpan(Request $request)
    {
        // save to auth group
        $namagroup = [
            'name' => $request->nama,
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $group = Auth_group::insertGetId($namagroup);
    
        // save to auth group permission
        foreach ($request->izin as $key ) {
            $data = [
                'group_id' => $group,
                'permission_id' => $key,
                'created_at' => date('Y-m-d H:i:s'), 
                'updated_at' => date('Y-m-d H:i:s')
            ];
            Auth_group_permission::insert($data);
        }
        
        return redirect()->route('grup')->with('message','Data Grup Berhasil Disimpan!');
    }
}
