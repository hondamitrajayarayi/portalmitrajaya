<?php

namespace App\Http\Controllers;

use App\Auth_user_permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Karyawan;
use App\Auth_group;
use App\Auth_user_group;
use App\TrxRbHeader;
use App\TrxRbDetailApproval;
use App\KaryawanOracle;

class AuthController extends Controller
{
    //
    public function index()
    {
        
        $data = User::paginate(10);
        $karyawan = Karyawan::orderBy('nama', 'ASC')->get();
        $grup = Auth_group::orderBy('name', 'Asc')->get();
        return view('master.user', compact('data','karyawan','grup'));
    }

    public function simpan(Request $request){
        
        $cek = User::where('username', '=', $request->nik)->first();
        if($cek){
            $karyawan = Karyawan::where('nik', '=', $request->nik)->firstOrFail();
            return redirect()->route('user')->with('message','User '.$karyawan->nama.' Sudah Ada!');
        }else{
            $validate = $request->validate([
                'nik'      => 'required',
                'password' => 'required|min:5',
                'level'    => 'required',
                'email'    => 'required|email',
            ],
            [
                'nik.required'      => 'Bidang ini tidak boleh kosong !',
                'password.required' => 'Bidang ini tidak boleh kosong !',
                'level.required'    => 'Bidang ini tidak boleh kosong !',
                'email.required'    => 'Bidang ini tidak boleh kosong !',
    
                'password.max' => 'Minimal 5 Karakter!',
            ]);

        }

        $karyawan = Karyawan::where('nik', '=', $request->nik)->firstOrFail();
        
        $data = [
            'name'      => $karyawan->nama,
            'username'  => $request->nik,
            'password'  => Hash::make($request->password),
            'email'     => $request->email,
            'status'     => 1,
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at' => date('Y-m-d H:i:s')
        ];

        User::insert($data);

        //update to mst karyawan in oracle
        $data3 = [
            'email'         => $request->email,
            'status_user'   => 1,
            'last_user'     => Auth::user()->username, 
            'updated_at'    => date('Y-m-d H.i.s')
        ];
        KaryawanOracle::where('nik', $request->nik)->update($data3);

        $data2 = [
            'userId'    => $request->nik,
            'groupId'   => $request->level,
            'created_at'    => date('Y-m-d H.i.s')
        ];

        Auth_user_group::insert($data2);

        if (!empty($request->izin)) {
            foreach ($request->izin as  $value) {
                # code...
                $data3 = [
                    'userId'        => $request->nik,
                    'permission_id' => $value,
                    'created_at'    => date('Y-m-d H.i.s')
                ];
        
                Auth_user_permission::insert($data3);
            }
        }        

        return redirect()->route('user')->with('message','Data '.$karyawan->nama.' Berhasil Disimpan!');
    }

    public function edit($id)
    {
        $data = User::where('username', '=', $id)->first();

        return response()->json($data);
    }

    public function update(Request $request)
    {

        if($request->password){
           
            $request->validate([
                'edit_email'        => 'required',
                // 'edit_level'        => 'required',
                'password'          => 'min:5',
            ],
            [
                'edit_email.required'   => 'Bidang ini tidak boleh kosong !',
                // 'edit_level.required'   => 'Bidang ini tidak boleh kosong !',
                'password.max'          => 'Minimal 5 Karakter!',
            ]);

            $data = [
                'password'  => Hash::make($request->password),
                // 'role'      => $request->edit_level,
                'email'     => $request->edit_email, 
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }else{
            $request->validate([
                'edit_email'        => 'required',
                // 'edit_level'             => 'required',
            ],
            [
                'edit_email.required'   => 'Bidang ini tidak boleh kosong !',
                // 'edit_level.required'        => 'Bidang ini tidak boleh kosong !',
            ]);

            $data = [
                // 'role'      => $request->edit_level,
                'email'     => $request->edit_email, 
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }
        
        User::where('username', $request->id)->update($data);
        
        //update to mst karyawan in oracle
        $data3 = [
            'email'         => $request->edit_email,
            'last_user'     => Auth::user()->username, 
            'updated_at'    => date('Y-m-d H.i.s')
        ];
        KaryawanOracle::where('nik', $request->id)->update($data3);

        return redirect()->route('user')->with('message','Data Berhasil Diubah!');

    }

    public function updateStatus(Request $request)
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
        
        User::where('username', $request->id)->update($data);

        //update to mst karyawan in oracle
        $data3 = [
            'status_user'   => $status,
            'last_user'     => Auth::user()->username, 
            'updated_at'    => date('Y-m-d H.i.s')
        ];
        KaryawanOracle::where('nik', $request->id)->update($data3);
        
        return response()->json([
            'success' => true,
        ]); 
    }

    public function hapus($id)
    {
        User::where('id', $id)->delete();

        return redirect()->back()->with('message','Data Berhasil Dihapus!');
    }

    public function login(Request $request){
        
        if (Auth::attempt(['username' => $request->username, 'password'=>$request->password])) {
            if(Auth::user()->status == 0){
                $request->session()->flush();
                Auth::logout();

                return redirect('/')->with('message','User tidak terdaftar!');
            }
            $cekAdmin= Karyawan::whereIn('id_jabatan',[4])->where('nik', Auth::user()->username)->first();
            if (!empty($cekAdmin)) {
                # code...
                $totalRb    = TrxRbHeader::where('created_by', Auth::user()->username)->count();
                $tolak      = TrxRbHeader::where('created_by', Auth::user()->username)->where('status',5)->count();
                $setuju     = TrxRbHeader::where('created_by', Auth::user()->username)->where('status',0)->count();
                $totalDana  = TrxRbHeader::where('created_by', Auth::user()->username)->where('status',0)->sum('total_harga');
            }

            $cekStaff = Karyawan::whereNotIn('id_jabatan',[4])->where('nik', Auth::user()->username)->first();
            if (!empty($cekStaff)) {
                # code...
                $totalRb    = TrxRbDetailApproval::where('approve_by', Auth::user()->username)
                                ->whereNotIn('status',[3])
                                ->count();
                $tolak      = TrxRbDetailApproval::where('approve_by', Auth::user()->username)
                                ->where('status',3)
                                ->count();
                $setuju     = TrxRbDetailApproval::where('approve_by', Auth::user()->username)
                                ->where('status',1)
                                ->count();
                $totalDana  = TrxRbDetailApproval::join('TRX_RB_HEADER','TRX_RB_HEADER.rb_id', '=', 'TRX_RB_DETAIL_APPROVAL.rb_id')
                                ->where('TRX_RB_DETAIL_APPROVAL.approve_by', Auth::user()->username)
                                ->where('TRX_RB_HEADER.status',0)
                                ->sum('TRX_RB_HEADER.total_harga');
            }
            return view('index', compact('totalRb','tolak','setuju','totalDana'));
        }
        return redirect('/')->with('message','Email atau Password salah!');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return redirect('/');
    }
}
