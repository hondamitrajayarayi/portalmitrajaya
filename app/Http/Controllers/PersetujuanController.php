<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\TrxRbHeader;
use App\TrxRbTracking;
use App\TrxRbDetailApproval;
use App\Karyawan;

class PersetujuanController extends Controller
{
    public function index()
    {
        $user = Karyawan::where('nik', Auth::user()->username)->first();
        $rb_id = [];
        $cek = TrxRbDetailApproval::where('approve_by', Auth::user()->username)->where('status',0)->get();
        
        if($cek != null){
            foreach ($cek as $key ) {
                # code...
                $rb_id[] = $key->rb_id;
            }
        }

        $data = TrxRbHeader::whereIn('rb_id', $rb_id)
            ->orderBy('created_date', 'DESC')
            ->paginate(10);
        
        return view('transaksi.persetujuan', compact('data','user'));
    }

    public function riwayat()
    {
        $user = Karyawan::where('nik', '=', Auth::user()->username)->first();
        $data = null;
        $cek = TrxRbDetailApproval::where('approve_by', Auth::user()->username)->whereIn('status',[1,2,3])->get();
        
        if(count($cek) != 0){
            
            foreach ($cek as $cek1) {
                $rb_id[] = $cek1->rb_id;
            }

            $data = TrxRbHeader::whereIn('rb_id', $rb_id)
                ->orderBy('created_date', 'DESC')
                ->paginate(10);
        }

        return view('transaksi.persetujuan_riwayat', compact('data','user'));
    }

    public function updateStatus(Request $request)
    {
        $cekuser= Karyawan::where('nik', '=', $request->id_user)->first();
        $rb     = TrxRbHeader::where('rb_id', '=', $request->rb_id)->first();
    
        // update status approval kacab atau kepala bengkel atau manager terkait
        if ($request->status == 2) {
            $data = [
                'status'        => $request->status,
                'update_user'   => $cekuser->nik,
                'update_date'   => date('Y-m-d H:i:s')
            ];

            $tracking = [
                'rb_id'         => $request->rb_id,
                'status'        => 'RB telah diketahui '.$cekuser->jabatan->nama_jabatan,
                'deskripsi'     => 'Pengajuan RB diketahui oleh '. $cekuser->jabatan->nama_jabatan,
                'id_user'       => $cekuser->nik,
                'created_date'  => date('Y-m-d H:i:s')
            ];

            $email = [
                'to'            => 'Admin',
                'rb_id'         => $request->rb_id,
                'cabang'        => $cekuser->cabang->branch_name,
                'pemohon'       => $rb->karyawan->nama,
                'mengetahui'    => $cekuser->nama,
                'j_mengetahui'  => $cekuser->AuthUsergrup->grup->name
            ];

            $approval = [
                'status'        => 1,
                'approve_date'  => date('Y-m-d H:i:s'),
            ];
            // dd($email);
            // kirim email ke evi atau kemana ?
            \Mail::to('detriawanrayi@gmail.com')->send(new \App\Mail\NewTicketToAdminHo($email));

            TrxRbHeader::where('rb_id', $request->rb_id)->update($data);
            TrxRbTracking::insert($tracking);
            TrxRbDetailApproval::where('rb_id', $request->rb_id)->update($approval);
            
            return redirect()->route('persetujuan')->with('message','RB Berhasil Diupdate!');
        }

        //update pembagian approval oleh evi
        if ($request->status == 3){
            $data = TrxRbHeader::where('rb_id', $request->rb_id)->first();
            $mengetahui = TrxRbDetailApproval::where('rb_id', $request->rb_id)->where('flag','MENGETAHUI')->where('status',0)->first();
            

            foreach($request->disetujui as $setuju){
                $disetujui = [
                    'rb_id'         => $request->rb_id,
                    'approve_by'    => $setuju,
                    'status'        => 0,
                    'flag'          => 'MENYETUJUI',
                    'approve_date'  => date('Y-m-d H:i:s'),
                ];

                $user = Karyawan::where('nik', '=', $setuju)->first();
                $email = [
                    'rb_id'         => $request->rb_id,
                    'to'            => $user->nama,
                    'cabang'        => $data->cabang->branch_name,
                    'pemohon'       => $data->karyawan->nama,
                    'mengetahui'    => (!empty($mengetahui) ? $mengetahui->karyawan->nama : null),
                    'j_mengetahui'  => (!empty($mengetahui) ? $mengetahui->karyawan->jabatan->nama_jabatan : null)
                ];

                \Mail::to($user->user->email)->send(new \App\Mail\NewTicketToApproval($email));
                TrxRbDetailApproval::insert($disetujui);
            }

            foreach($request->diketahui as $result){
                $diketahui = [
                    'rb_id'         => $request->rb_id,
                    'approve_by'    => $result,
                    'status'        => 0,
                    'flag'          => 'MENGETAHUI',
                    'approve_date'  => date('Y-m-d H:i:s'),
                ];

                $user = Karyawan::where('nik', '=', $result)->first();
                $email = [
                    'rb_id'         => $request->rb_id,
                    'to'            => $user->nama,
                    'cabang'        => $data->cabang->branch_name,
                    'pemohon'       => $data->karyawan->nama,
                    'mengetahui'    => (!empty($mengetahui) ? $mengetahui->karyawan->nama : null),
                    'j_mengetahui'  => (!empty($mengetahui) ? $mengetahui->karyawan->jabatan->nama_jabatan : null)
                ];
        
                \Mail::to($user->user->email)->send(new \App\Mail\NewTicketToApproval($email));
                TrxRbDetailApproval::insert($diketahui);
            }
            
            $data = [
                'status'        => $request->status,
                'update_user'   => $cekuser->nik,
                'update_date'   => date('Y-m-d H:i:s')
            ];

            $tracking = [
                'rb_id'         => $request->rb_id,
                'status'        => 'Menunggu approval Management',
                'deskripsi'     => 'Admin RB telah melakukan penugasan untuk segera di approve',
                'id_user'       => $cekuser->nik,
                'created_date'  => date('Y-m-d H:i:s')
            ];

            TrxRbHeader::where('rb_id', $request->rb_id)->update($data);
            TrxRbTracking::insert($tracking);

            return redirect()->route('pengesahan')->with('message','RB Berhasil Diupdate!');
        }

        //approval terkait
        if ($request->status == 4) {
            
            $data = [
                'status'        => $request->status,
                'update_user'   => $cekuser->nik,
                'update_date'   => date('Y-m-d H:i:s')
            ];
            $ceks = TrxRbDetailApproval::where('rb_id', $request->rb_id)->where('approve_by', $cekuser->nik)->first();
            
            $tracking = [
                'rb_id'         => $request->rb_id,
                'status'        => ($ceks->flag == 'MENGETAHUI') ? 'RB telah diketahui '.$cekuser->jabatan->nama_jabatan .' '.$cekuser->departemen->nama_dept : 'RB telah disetujui '.$cekuser->jabatan->nama_jabatan .' '.$cekuser->departemen->nama_dept,
                'deskripsi'     => ($ceks->flag == 'MENGETAHUI') ? 'Pengajuan RB sudah diketahui oleh '. $cekuser->jabatan->nama_jabatan .' '.$cekuser->departemen->nama_dept : 'Pengajuan RB sudah disetujui oleh '. $cekuser->jabatan->nama_jabatan.' '.$cekuser->departemen->nama_dept,
                'id_user'       => $cekuser->nik,
                'created_date'  => date('Y-m-d H:i:s')
            ];

            $approval = [
                'status'        => 1,
                'approve_date'  => date('Y-m-d H:i:s'),
            ];
            
            TrxRbHeader::where('rb_id', $request->rb_id)->update($data);
            TrxRbTracking::insert($tracking);
            TrxRbDetailApproval::where('rb_id', $request->rb_id)->where('approve_by', $cekuser->nik)->update($approval);

            $ceks2 = TrxRbDetailApproval::where('rb_id', $request->rb_id)->where('status', 0)->get();
            
            if (count($ceks2) == 0) {
                $data = [
                    'status'        => 6,
                    'update_user'   => $cekuser->nik,
                    'update_date'   => date('Y-m-d H:i:s', strtotime(Carbon::now()->addMinutes(1)))
                ];
                $tracking = [
                    'rb_id'         => $request->rb_id,
                    'status'        => 'RB selesai disetujui management',
                    'deskripsi'     => 'Pengajuan telah selesai disetujui oleh management. Selanjutnya Menunggu otorisasi/pencairan (Kudus)',
                    'id_user'       => $cekuser->nik,
                    'created_date'  => date('Y-m-d H:i:s', strtotime(Carbon::now()->addMinutes(1)))
                ];
                
                // kirim email ke kudus
                $email = [
                    'rb_id'         => $request->rb_id,
                    'cabang'        => $rb->cabang->branch_name,
                    'pemohon'       => $rb->karyawan->nama,
                ];
                
                \Mail::to($rb->karyawan->user->email)->send(new \App\Mail\NewTicketToKudus($email));
                
                TrxRbHeader::where('rb_id', $request->rb_id)->update($data);
                TrxRbTracking::insert($tracking);
            }

            return redirect()->route('persetujuan')->with('message','RB Berhasil Diupdate!');
        }

        //pengajuan ditolak
        if ($request->status == 5) {
            
            // kirim email tolak
            $email = [
                'rb_id'         => $request->rb_id,
                'cabang'        => $rb->cabang->branch_name,
                'pemohon'       => $rb->karyawan->nama,
                'ditolak'       => $cekuser->nama,
                'j_ditolak'     => $cekuser->jabatan->nama_jabatan,
                'd_ditolak'     => $cekuser->departemen->nama_dept,
            ];
            
            \Mail::to($rb->karyawan->user->email)->send(new \App\Mail\NewTicketToPengajuTolak($email));
            
            // update status di header
            $data = [
                'status'        => $request->status,
                'update_user'   => $cekuser->nik,
                'update_date'   => date('Y-m-d H:i:s')
            ];
            
            // update tracking
            $tracking = [
                [
                    'rb_id'         => $request->rb_id,
                    'status'        => 'Pengajuan ditolak oleh '. $cekuser->jabatan->nama_jabatan .' '.$cekuser->departemen->nama_dept .'!',
                    'deskripsi'     => $request->alasantolak,
                    'id_user'       => $cekuser->nik,
                    'created_date'  => date('Y-m-d H:i:s')
                ],[
                    'rb_id'         => $request->rb_id,
                    'status'        => 'RB closed !',
                    'deskripsi'     => 'Silahkan untuk mengajukan RB baru!',
                    'id_user'       => $cekuser->nik,
                    'created_date'  => date('Y-m-d H:i:s', strtotime(Carbon::now()->addMinutes(1)))
                ]
            ];

            // update approval
            $approval = [
                'status'        => 2, //status batal
                'approve_date'  => date('Y-m-d H:i:s'),
            ];

            $approval2 = [
                'status'        => 3, //status batal (untuk user yg tidak membatalkan tidak bisa diproses)
                'approve_date'  => date('Y-m-d H:i:s', strtotime(Carbon::now()->addMinutes(1))),
            ];

            TrxRbHeader::where('rb_id', $request->rb_id)->update($data);
            TrxRbTracking::insert($tracking);
            TrxRbDetailApproval::where('rb_id', $request->rb_id)
                ->where('approve_by', $cekuser->nik)
                ->update($approval);
            TrxRbDetailApproval::where('rb_id', $request->rb_id)
                ->whereNotIn('status', [1])
                ->whereNotIn('approve_by', [$cekuser->nik])
                ->update($approval2);
            
            return redirect()->route('persetujuan')->with('message','RB Berhasil Dibatalkan!');
        }

        if ($request->status == 0) {
            $file = $request->buktitf;
            $nama_ft = $request->rb_id. '-' .$file->getClientOriginalName();
            
            $file->move('buktitf', $nama_ft);

            $data = [
                'status'        => $request->status,
                'update_user'   => $cekuser->nik,
                'bukti_tf'       => $nama_ft,
                'update_date'   => date('Y-m-d H:i:s')
            ];

            $tracking = [
                'rb_id'         => $request->rb_id,
                'status'        => 'Dana telah ditransfer',
                'deskripsi'     => 'Pengajuan dana telah ditransfer',
                'id_user'       => $cekuser->nik,
                'created_date'  => date('Y-m-d H:i:s')
            ];

            $email = [
                'rb_id'         => $request->rb_id,
                'cabang'        => $rb->cabang->branch_name,
                'pemohon'       => $rb->karyawan->nama,
            ];
            
            \Mail::to($rb->karyawan->user->email)->send(new \App\Mail\NewTicketToPengaju($email));

            TrxRbHeader::where('rb_id', $request->rb_id)->update($data);
            TrxRbTracking::insert($tracking);

            return redirect()->route('otorisasi')->with('message','RB Berhasil Diupdate!');
        }
    }
}
