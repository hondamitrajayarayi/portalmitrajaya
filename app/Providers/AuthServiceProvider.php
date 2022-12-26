<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use DB;
use Auth;
use Carbon\Carbon;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model\User' => 'App\Policies\DivisiPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
      $this->registerPolicies();

        //
        /* define a admin user role */
      // master data
      Gate::define('menu_mst_user', function ($user){

            $id = $user->username;
            $now = Carbon::now();

            $cekMenu = DB::connection('mysql')->select("
               SELECT users.username, users.name, auth_user_groups.groupId, auth_groups.name as grup, auth_permissions.name as permissions_name, auth_permissions.menuCode FROM users 
               join auth_user_groups on auth_user_groups.userId = users.username
               join auth_groups on auth_groups.id = auth_user_groups.groupId
               join auth_group_permissions on auth_group_permissions.group_id = auth_groups.id
               join auth_permissions on auth_permissions.id = auth_group_permissions.permission_id
               where users.username = '$id' and menuCode = 'menu_mst_user'
            ");

            $cekMenu2 = DB::connection('mysql')->select("
               SELECT * FROM auth_user_permissions
               JOIN auth_permissions on auth_permissions.id = auth_user_permissions.permission_id
               WHERE auth_permissions.menuCode = 'menu_mst_user' and auth_user_permissions.userId = '$id'
            ");

            if (!empty($cekMenu) || !empty($cekMenu2)) {
               return true;
            }
      
            return false;
      });
      Gate::define('menu_mst_grup', function ($user){

            $id = $user->username;
            $now = Carbon::now();

            $cekMenu = DB::connection('mysql')->select("
               SELECT users.username, users.name, auth_user_groups.groupId, auth_groups.name as grup, auth_permissions.name as permissions_name, auth_permissions.menuCode FROM users 
               join auth_user_groups on auth_user_groups.userId = users.username
               join auth_groups on auth_groups.id = auth_user_groups.groupId
               join auth_group_permissions on auth_group_permissions.group_id = auth_groups.id
               join auth_permissions on auth_permissions.id = auth_group_permissions.permission_id
               where users.username = '$id' and menuCode = 'menu_mst_grup'
            ");

            $cekMenu2 = DB::connection('mysql')->select("
               SELECT * FROM auth_user_permissions
               JOIN auth_permissions on auth_permissions.id = auth_user_permissions.permission_id
               WHERE auth_permissions.menuCode = 'menu_mst_grup' and auth_user_permissions.userId = '$id'
            ");

            if (!empty($cekMenu) || !empty($cekMenu2)) {
               return true;
            }
      
            return false;
      });
      Gate::define('menu_mst_karyawan', function ($user){

            $id = $user->username;
            $now = Carbon::now();

            $cekMenu = DB::connection('mysql')->select("
               SELECT users.username, users.name, auth_user_groups.groupId, auth_groups.name as grup, auth_permissions.name as permissions_name, auth_permissions.menuCode FROM users 
               join auth_user_groups on auth_user_groups.userId = users.username
               join auth_groups on auth_groups.id = auth_user_groups.groupId
               join auth_group_permissions on auth_group_permissions.group_id = auth_groups.id
               join auth_permissions on auth_permissions.id = auth_group_permissions.permission_id
               where users.username = '$id' and menuCode = 'menu_mst_karyawan'
            ");

            $cekMenu2 = DB::connection('mysql')->select("
               SELECT * FROM auth_user_permissions
               JOIN auth_permissions on auth_permissions.id = auth_user_permissions.permission_id
               WHERE auth_permissions.menuCode = 'menu_mst_karyawan' and auth_user_permissions.userId = '$id'
            ");

            if (!empty($cekMenu) || !empty($cekMenu2)) {
               return true;
            }
            return false;
      });
      Gate::define('menu_mst_departement', function ($user){

         $id = $user->username;
         $now = Carbon::now();

         $cekMenu = DB::connection('mysql')->select("
            SELECT users.username, users.name, auth_user_groups.groupId, auth_groups.name as grup, auth_permissions.name as permissions_name, auth_permissions.menuCode FROM users 
            join auth_user_groups on auth_user_groups.userId = users.username
            join auth_groups on auth_groups.id = auth_user_groups.groupId
            join auth_group_permissions on auth_group_permissions.group_id = auth_groups.id
            join auth_permissions on auth_permissions.id = auth_group_permissions.permission_id
            where users.username = '$id' and menuCode = 'menu_mst_departement'
         ");

         $cekMenu2 = DB::connection('mysql')->select("
               SELECT * FROM auth_user_permissions
               JOIN auth_permissions on auth_permissions.id = auth_user_permissions.permission_id
               WHERE auth_permissions.menuCode = 'menu_mst_departement' and auth_user_permissions.userId = '$id'
         ");

         if (!empty($cekMenu) || !empty($cekMenu2)) {
            return true;
         }
         return false;
      });
      Gate::define('menu_mst_branch', function ($user){

         $id = $user->username;
         $now = Carbon::now();

         $cekMenu = DB::connection('mysql')->select("
            SELECT users.username, users.name, auth_user_groups.groupId, auth_groups.name as grup, auth_permissions.name as permissions_name, auth_permissions.menuCode FROM users 
            join auth_user_groups on auth_user_groups.userId = users.username
            join auth_groups on auth_groups.id = auth_user_groups.groupId
            join auth_group_permissions on auth_group_permissions.group_id = auth_groups.id
            join auth_permissions on auth_permissions.id = auth_group_permissions.permission_id
            where users.username = '$id' and menuCode = 'menu_mst_branch'
         ");

         $cekMenu2 = DB::connection('mysql')->select("
               SELECT * FROM auth_user_permissions
               JOIN auth_permissions on auth_permissions.id = auth_user_permissions.permission_id
               WHERE auth_permissions.menuCode = 'menu_mst_branch' and auth_user_permissions.userId = '$id'
         ");

         if (!empty($cekMenu) || !empty($cekMenu2)) {
            return true;
         }
         return false;
      });
      Gate::define('menu_mst_jabatan', function ($user){

         $id = $user->username;
         $now = Carbon::now();

         $cekMenu = DB::connection('mysql')->select("
            SELECT users.username, users.name, auth_user_groups.groupId, auth_groups.name as grup, auth_permissions.name as permissions_name, auth_permissions.menuCode FROM users 
            join auth_user_groups on auth_user_groups.userId = users.username
            join auth_groups on auth_groups.id = auth_user_groups.groupId
            join auth_group_permissions on auth_group_permissions.group_id = auth_groups.id
            join auth_permissions on auth_permissions.id = auth_group_permissions.permission_id
            where users.username = '$id' and menuCode = 'menu_mst_jabatan'
         ");

         $cekMenu2 = DB::connection('mysql')->select("
               SELECT * FROM auth_user_permissions
               JOIN auth_permissions on auth_permissions.id = auth_user_permissions.permission_id
               WHERE auth_permissions.menuCode = 'menu_mst_jabatan' and auth_user_permissions.userId = '$id'
         ");

         if (!empty($cekMenu) || !empty($cekMenu2)) {
            return true;
         }
         return false;
      });
      Gate::define('menu_mst_jenis_inventaris', function ($user){

         $id = $user->username;
         $now = Carbon::now();

         $cekMenu = DB::connection('mysql')->select("
            SELECT users.username, users.name, auth_user_groups.groupId, auth_groups.name as grup, auth_permissions.name as permissions_name, auth_permissions.menuCode FROM users 
            join auth_user_groups on auth_user_groups.userId = users.username
            join auth_groups on auth_groups.id = auth_user_groups.groupId
            join auth_group_permissions on auth_group_permissions.group_id = auth_groups.id
            join auth_permissions on auth_permissions.id = auth_group_permissions.permission_id
            where users.username = '$id' and menuCode = 'menu_mst_jenis_inventaris'
         ");

         $cekMenu2 = DB::connection('mysql')->select("
               SELECT * FROM auth_user_permissions
               JOIN auth_permissions on auth_permissions.id = auth_user_permissions.permission_id
               WHERE auth_permissions.menuCode = 'menu_mst_jenis_inventaris' and auth_user_permissions.userId = '$id'
         ");

         if (!empty($cekMenu) || !empty($cekMenu2)) {
            return true;
         }
         return false;
      });
      Gate::define('menu_mst_grup_inventaris', function ($user){

         $id = $user->username;
         $now = Carbon::now();

         $cekMenu = DB::connection('mysql')->select("
            SELECT users.username, users.name, auth_user_groups.groupId, auth_groups.name as grup, auth_permissions.name as permissions_name, auth_permissions.menuCode FROM users 
            join auth_user_groups on auth_user_groups.userId = users.username
            join auth_groups on auth_groups.id = auth_user_groups.groupId
            join auth_group_permissions on auth_group_permissions.group_id = auth_groups.id
            join auth_permissions on auth_permissions.id = auth_group_permissions.permission_id
            where users.username = '$id' and menuCode = 'menu_mst_grup_inventaris'
         ");

         $cekMenu2 = DB::connection('mysql')->select("
               SELECT * FROM auth_user_permissions
               JOIN auth_permissions on auth_permissions.id = auth_user_permissions.permission_id
               WHERE auth_permissions.menuCode = 'menu_mst_grup_inventaris' and auth_user_permissions.userId = '$id'
         ");

         if (!empty($cekMenu) || !empty($cekMenu2)) {
            return true;
         }
         return false;
      });
      Gate::define('menu_mst_bank', function ($user){

         $id = $user->username;
         $now = Carbon::now();

         $cekMenu = DB::connection('mysql')->select("
            SELECT users.username, users.name, auth_user_groups.groupId, auth_groups.name as grup, auth_permissions.name as permissions_name, auth_permissions.menuCode FROM users 
            join auth_user_groups on auth_user_groups.userId = users.username
            join auth_groups on auth_groups.id = auth_user_groups.groupId
            join auth_group_permissions on auth_group_permissions.group_id = auth_groups.id
            join auth_permissions on auth_permissions.id = auth_group_permissions.permission_id
            where users.username = '$id' and menuCode = 'menu_mst_bank'
         ");

         $cekMenu2 = DB::connection('mysql')->select("
               SELECT * FROM auth_user_permissions
               JOIN auth_permissions on auth_permissions.id = auth_user_permissions.permission_id
               WHERE auth_permissions.menuCode = 'menu_mst_bank' and auth_user_permissions.userId = '$id'
         ");

         if (!empty($cekMenu) || !empty($cekMenu2)) {
            return true;
         }
         return false;
      });

      // rb
      Gate::define('menu_pengajuan', function ($user){

         $id = $user->username;
         $now = Carbon::now();

         $cekMenu = DB::connection('mysql')->select("
            SELECT users.username, users.name, auth_user_groups.groupId, auth_groups.name as grup, auth_permissions.name as permissions_name, auth_permissions.menuCode FROM users 
            join auth_user_groups on auth_user_groups.userId = users.username
            join auth_groups on auth_groups.id = auth_user_groups.groupId
            join auth_group_permissions on auth_group_permissions.group_id = auth_groups.id
            join auth_permissions on auth_permissions.id = auth_group_permissions.permission_id
            where users.username = '$id' and menuCode = 'menu_pengajuan'
         ");

         $cekMenu2 = DB::connection('mysql')->select("
               SELECT * FROM auth_user_permissions
               JOIN auth_permissions on auth_permissions.id = auth_user_permissions.permission_id
               WHERE auth_permissions.menuCode = 'menu_pengajuan' and auth_user_permissions.userId = '$id'
         ");

         if (!empty($cekMenu) || !empty($cekMenu2)) {
            return true;
         }
         return false;
      });
      Gate::define('menu_persetujuan', function ($user){

         $id = $user->username;
         $now = Carbon::now();

         $cekMenu = DB::connection('mysql')->select("
            SELECT users.username, users.name, auth_user_groups.groupId, auth_groups.name as grup, auth_permissions.name as permissions_name, auth_permissions.menuCode FROM users 
            join auth_user_groups on auth_user_groups.userId = users.username
            join auth_groups on auth_groups.id = auth_user_groups.groupId
            join auth_group_permissions on auth_group_permissions.group_id = auth_groups.id
            join auth_permissions on auth_permissions.id = auth_group_permissions.permission_id
            where users.username = '$id' and menuCode = 'menu_persetujuan'
         ");

         $cekMenu2 = DB::connection('mysql')->select("
               SELECT * FROM auth_user_permissions
               JOIN auth_permissions on auth_permissions.id = auth_user_permissions.permission_id
               WHERE auth_permissions.menuCode = 'menu_persetujuan' and auth_user_permissions.userId = '$id'
         ");

         if (!empty($cekMenu) || !empty($cekMenu2)) {
            return true;
         }
         return false;
      });
      Gate::define('menu_pengesahan', function ($user){

         $id = $user->username;
         $now = Carbon::now();

         $cekMenu = DB::connection('mysql')->select("
            SELECT users.username, users.name, auth_user_groups.groupId, auth_groups.name as grup, auth_permissions.name as permissions_name, auth_permissions.menuCode FROM users 
            join auth_user_groups on auth_user_groups.userId = users.username
            join auth_groups on auth_groups.id = auth_user_groups.groupId
            join auth_group_permissions on auth_group_permissions.group_id = auth_groups.id
            join auth_permissions on auth_permissions.id = auth_group_permissions.permission_id
            where users.username = '$id' and menuCode = 'menu_pengesahan'
         ");

         $cekMenu2 = DB::connection('mysql')->select("
               SELECT * FROM auth_user_permissions
               JOIN auth_permissions on auth_permissions.id = auth_user_permissions.permission_id
               WHERE auth_permissions.menuCode = 'menu_pengesahan' and auth_user_permissions.userId = '$id'
         ");

         if (!empty($cekMenu) || !empty($cekMenu2)) {
            return true;
         }
         return false;
      });
      Gate::define('menu_otorisasi', function ($user){

         $id = $user->username;
         $now = Carbon::now();

         $cekMenu = DB::connection('mysql')->select("
            SELECT users.username, users.name, auth_user_groups.groupId, auth_groups.name as grup, auth_permissions.name as permissions_name, auth_permissions.menuCode FROM users 
            join auth_user_groups on auth_user_groups.userId = users.username
            join auth_groups on auth_groups.id = auth_user_groups.groupId
            join auth_group_permissions on auth_group_permissions.group_id = auth_groups.id
            join auth_permissions on auth_permissions.id = auth_group_permissions.permission_id
            where users.username = '$id' and menuCode = 'menu_otorisasi'
         ");

         $cekMenu2 = DB::connection('mysql')->select("
               SELECT * FROM auth_user_permissions
               JOIN auth_permissions on auth_permissions.id = auth_user_permissions.permission_id
               WHERE auth_permissions.menuCode = 'menu_otorisasi' and auth_user_permissions.userId = '$id'
         ");

         if (!empty($cekMenu) || !empty($cekMenu2)) {
            return true;
         }
         return false;
      });

      // inventaris
      Gate::define('menu_data_inventaris', function ($user){

         $id = $user->username;
         $now = Carbon::now();

         $cekMenu = DB::connection('mysql')->select("
            SELECT users.username, users.name, auth_user_groups.groupId, auth_groups.name as grup, auth_permissions.name as permissions_name, auth_permissions.menuCode FROM users 
            join auth_user_groups on auth_user_groups.userId = users.username
            join auth_groups on auth_groups.id = auth_user_groups.groupId
            join auth_group_permissions on auth_group_permissions.group_id = auth_groups.id
            join auth_permissions on auth_permissions.id = auth_group_permissions.permission_id
            where users.username = '$id' and menuCode = 'menu_data_inventaris'
         ");

         $cekMenu2 = DB::connection('mysql')->select("
               SELECT * FROM auth_user_permissions
               JOIN auth_permissions on auth_permissions.id = auth_user_permissions.permission_id
               WHERE auth_permissions.menuCode = 'menu_data_inventaris' and auth_user_permissions.userId = '$id'
         ");

         if (!empty($cekMenu) || !empty($cekMenu2)) {
            return true;
         }
         return false;
      });
      Gate::define('menu_query_inventaris', function ($user){

         $id = $user->username;
         $now = Carbon::now();

         $cekMenu = DB::connection('mysql')->select("
            SELECT users.username, users.name, auth_user_groups.groupId, auth_groups.name as grup, auth_permissions.name as permissions_name, auth_permissions.menuCode FROM users 
            join auth_user_groups on auth_user_groups.userId = users.username
            join auth_groups on auth_groups.id = auth_user_groups.groupId
            join auth_group_permissions on auth_group_permissions.group_id = auth_groups.id
            join auth_permissions on auth_permissions.id = auth_group_permissions.permission_id
            where users.username = '$id' and menuCode = 'menu_query_inventaris'
         ");

         $cekMenu2 = DB::connection('mysql')->select("
               SELECT * FROM auth_user_permissions
               JOIN auth_permissions on auth_permissions.id = auth_user_permissions.permission_id
               WHERE auth_permissions.menuCode = 'menu_query_inventaris' and auth_user_permissions.userId = '$id'
         ");

         if (!empty($cekMenu) || !empty($cekMenu2)) {
            return true;
         }
         return false;
      });
      Gate::define('menu_peminjaman', function ($user){

         $id = $user->username;
         $now = Carbon::now();

         $cekMenu = DB::connection('mysql')->select("
            SELECT users.username, users.name, auth_user_groups.groupId, auth_groups.name as grup, auth_permissions.name as permissions_name, auth_permissions.menuCode FROM users 
            join auth_user_groups on auth_user_groups.userId = users.username
            join auth_groups on auth_groups.id = auth_user_groups.groupId
            join auth_group_permissions on auth_group_permissions.group_id = auth_groups.id
            join auth_permissions on auth_permissions.id = auth_group_permissions.permission_id
            where users.username = '$id' and menuCode = 'menu_peminjaman'
         ");

         $cekMenu2 = DB::connection('mysql')->select("
               SELECT * FROM auth_user_permissions
               JOIN auth_permissions on auth_permissions.id = auth_user_permissions.permission_id
               WHERE auth_permissions.menuCode = 'menu_peminjaman' and auth_user_permissions.userId = '$id'
         ");

         if (!empty($cekMenu) || !empty($cekMenu2)) {
            return true;
         }
         return false;
      });
      Gate::define('menu_pemeliharaan', function ($user){

         $id = $user->username;
         $now = Carbon::now();

         $cekMenu = DB::connection('mysql')->select("
            SELECT users.username, users.name, auth_user_groups.groupId, auth_groups.name as grup, auth_permissions.name as permissions_name, auth_permissions.menuCode FROM users 
            join auth_user_groups on auth_user_groups.userId = users.username
            join auth_groups on auth_groups.id = auth_user_groups.groupId
            join auth_group_permissions on auth_group_permissions.group_id = auth_groups.id
            join auth_permissions on auth_permissions.id = auth_group_permissions.permission_id
            where users.username = '$id' and menuCode = 'menu_pemeliharaan'
         ");

         $cekMenu2 = DB::connection('mysql')->select("
               SELECT * FROM auth_user_permissions
               JOIN auth_permissions on auth_permissions.id = auth_user_permissions.permission_id
               WHERE auth_permissions.menuCode = 'menu_pemeliharaan' and auth_user_permissions.userId = '$id'
         ");

         if (!empty($cekMenu) || !empty($cekMenu2)) {
            return true;
         }
         return false;
      });


         // Gate::define('isAdmin', function($user) {
         //    return $user->role == 'admin';
         // });

         // Gate::define('isTeknisi', function($user) {
         //    return $user->role == 'teknisi';
         // });

         // Gate::define('isUser', function($user) {
         //    return $user->role == 'user';
         // });
        
         // /* define a manager user role */
         // Gate::define('isTeknisiNadmin', function($user) {
         //    return in_array($user->role, ['teknisi', 'admin']);
         // });
       
         // /* define a user role */
         // Gate::define('isUserNadmin', function($user) {
         //    return in_array($user->role, ['user', 'admin']);
         // });
   }
}
