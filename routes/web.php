<?php

use Illuminate\Support\Facades\Route;
use App\TrxRbHeader;
use App\TrxRbDetailApproval;
use App\Karyawan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Auth::routes();

// Route::get('/page', function ()
// {
//     return view('layouts.test');
// });

// Route::get('/','AuthController@index')->name('login');
Route::get('/','Auth\LoginController@showLoginForm')->name('login');
Route::post('/','AuthController@login')->name('login');
// Route::post('/','Auth\LoginController@login')->name('login');
Route::post('/logout','AuthController@logout')->name('logout');

// // Route::group(['middleware' => 'CekloginMiddleware'], function (){
Route::group(['middleware' => 'auth'], function (){
    Route::post('/resetpassword','AuthController@resetpassword')->name('reset.password');
    Route::get('/dashboard', function () { 
        // jika yg login pembuat tiket
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
                            ->where('status',2)
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
    })->name('/home');

    Route::group(['middleware' => 'can:menu_mst_karyawan'], function (){
        Route::get('karyawan','KaryawanController@index')->name('karyawan');
        Route::post('karyawan/simpan','KaryawanController@simpan')->name('karyawan.simpan');
        Route::get('karyawan/{id}/edit','KaryawanController@edit')->name('karyawan.edit');
        Route::post('karyawan/update','KaryawanController@update')->name('karyawan.update');
        Route::delete('karyawan/delete/{id}','KaryawanController@hapus')->name('karyawan.hapus');
    });
    Route::group(['middleware' => 'can:menu_mst_user'], function (){
        Route::get('user','AuthController@index')->name('user');
        Route::post('user/simpan','AuthController@simpan')->name('user.simpan');
        Route::get('user/{id}/edit','AuthController@edit')->name('user.edit');
        Route::post('user/update','AuthController@update')->name('user.update');
        Route::post('user/update/status','AuthController@updateStatus')->name('user.update.status');
        Route::delete('user/delete/{id}','AuthController@hapus')->name('user.hapus');
    });
    Route::group(['middleware' => 'can:menu_mst_grup'], function (){
        Route::get('group','GroupController@index')->name('grup');
        Route::post('group/simpan','GroupController@simpan')->name('grup.simpan');
        // Route::get('user/{id}/edit','AuthController@edit')->name('user.edit');
        // Route::post('user/update','AuthController@update')->name('user.update');
        // Route::delete('user/delete/{id}','AuthController@hapus')->name('user.hapus');
    });
    Route::group(['middleware' => 'can:menu_mst_departement'], function (){
        Route::get('departemen','DepartemenController@index')->name('departemen');
        Route::post('departemen/simpan','DepartemenController@simpan')->name('departemen.simpan');
        Route::get('departemen/{id}/edit','DepartemenController@edit')->name('departemen.edit');
        Route::post('departemen/update','DepartemenController@update')->name('departemen.update');
        Route::delete('departemen/delete/{id}','DepartemenController@hapus')->name('departemen.hapus');
    });
    Route::group(['middleware' => 'can:menu_mst_branch'], function (){
        Route::get('branch','BranchController@index')->name('branch');
        Route::post('branch/simpan','BranchController@simpan')->name('branch.simpan');
        Route::get('branch/{id}/edit','BranchController@edit')->name('branch.edit');
        Route::post('branch/update','BranchController@update')->name('branch.update');
        Route::delete('branch/delete/{id}','BranchController@hapus')->name('branch.hapus');
    });
    Route::group(['middleware' => 'can:menu_mst_jabatan'], function (){
        Route::get('jabatan','JabatanController@index')->name('jabatan');
        Route::post('jabatan/simpan','JabatanController@simpan')->name('jabatan.simpan');
        Route::get('jabatan/{id}/edit','JabatanController@edit')->name('jabatan.edit');
        Route::post('jabatan/update','JabatanController@update')->name('jabatan.update');
        Route::delete('jabatan/delete/{id}','JabatanController@hapus')->name('jabatan.hapus');
    });
    Route::group(['middleware' => 'can:menu_mst_jenis_inventaris'], function (){
        Route::get('inventaris/jenis','InventarisController@masterjenis')->name('inventaris.jenis');
    });
    Route::group(['middleware' => 'can:menu_mst_grup_inventaris'], function (){
        Route::get('inventaris/group','InventarisController@mastergroup')->name('inventaris.group');
    });

    // rb
    Route::post('bank/getnorekening','PengajuanController@getnorekening');

    Route::group(['middleware' => 'can:menu_pengajuan'], function (){
        Route::get('pengajuan/riwayat','PengajuanController@list')->name('pengajuan.list');
        Route::get('pengajuan','PengajuanController@index')->name('pengajuan.baru');
        Route::post('pengajuan/simpan','PengajuanController@simpan')->name('pengajuan.simpan');
    });
    Route::get('pengajuan/detail/{id}','PengajuanController@detail')->name('pengajuan.detail');
    Route::post('persetujuan/update','PersetujuanController@updateStatus')->name('persetujuan.update');
    Route::group(['middleware' => 'can:menu_persetujuan'], function (){
        Route::get('persetujuan','PersetujuanController@index')->name('persetujuan');
        Route::get('riwayat/persetujuan','PersetujuanController@riwayat')->name('persetujuan.riwayat');

    });
    Route::group(['middleware' => 'can:menu_pengesahan'], function (){
        Route::get('pengesahan','PengesahanController@index')->name('pengesahan');
        Route::post('pengesahan/update','PengesahanController@updateStatus')->name('pengesahan.update');
        Route::get('riwayat/pengesahan','PengesahanController@riwayat')->name('pengesahan.riwayat');
    });
    Route::group(['middleware' => 'can:menu_otorisasi'], function (){
        Route::get('otorisasi','OtorisasiController@index')->name('otorisasi');
        Route::post('otorisasi/update','OtorisasiController@update')->name('otorisasi.update');
        Route::get('riwayat/otorisasi','OtorisasiController@riwayat')->name('otorisasi.riwayat');
    });

    // inventaris
    Route::group(['middleware' => 'can:menu_data_inventaris'], function (){
        Route::get('inventaris','InventarisController@index')->name('inventaris');
        Route::get('inventaris/tambah','InventarisController@tambah')->name('inventaris.tambah');
        Route::post('inventaris/getjenis','InventarisController@jenis');
        Route::post('inventaris/autofillrb','InventarisController@pilihrb')->name('inventaris.pilihrb');
        Route::post('inventaris/simpan','InventarisController@simpan')->name('inventaris.simpan');
        Route::post('inventaris/generateqr','InventarisController@generateqr')->name('inventaris.generateqr');
    });
    Route::group(['middleware' => 'can:menu_query_inventaris'], function (){
        Route::get('inventaris/getinfo',function (){
                return view('inventori.inventory_cari');
            })->name('inventaris.getinfo1');
        Route::post('inventaris/getinfo','InventarisController@getinfo')->name('inventaris.getinfo');
    });
    Route::group(['middleware' => 'can:menu_peminjaman'], function (){
        Route::get('inventaris/peminjaman','InventarisController@peminjaman')->name('inventaris.peminjaman');
        Route::get('inventaris/peminjaman/tambah','InventarisController@tambahpeminjaman')->name('inventaris.peminjaman.tambah');
        Route::get('inventaris/{id}/pengembalian','InventarisController@editpeminjaman');
        Route::post('inventaris/peminjaman/simpan','InventarisController@simpanpeminjaman')->name('inventaris.peminjaman.simpan');
        Route::post('inventaris/peminjaman/update','InventarisController@updatepeminjaman')->name('inventaris.peminjaman.update');
    });
    Route::group(['middleware' => 'can:menu_pemeliharaan'], function (){

    });
    
    Route::get('logout','AuthController@logout')->name('logout');
});



Route::get('/tes', function ()
{
    return view('email.newTicketAdmin');
});


Route::get('/home', 'HomeController@index')->name('home');
?>