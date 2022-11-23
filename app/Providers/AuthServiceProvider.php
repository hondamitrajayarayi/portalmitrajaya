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

            if (!empty($cekMenu)) {
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

            if (!empty($cekMenu)) {
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

            if (!empty($cekMenu)) {
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

         if (!empty($cekMenu)) {
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

         if (!empty($cekMenu)) {
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

         if (!empty($cekMenu)) {
            return true;
         }
         return false;
      });
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

         if (!empty($cekMenu)) {
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

         if (!empty($cekMenu)) {
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

         if (!empty($cekMenu)) {
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

         if (!empty($cekMenu)) {
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
