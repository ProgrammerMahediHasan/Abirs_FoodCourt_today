<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $perms = [
            'orders.view',
            'orders.create',
            'orders.payment',
            'reports.view',
            'staff.manage',
        ];

        foreach ($perms as $p) {
            DB::table('permissions')->updateOrInsert(
                ['name' => $p, 'guard_name' => 'web'],
                ['name' => $p, 'guard_name' => 'web']
            );
        }

        $roles = ['Admin','Manager','Cashier','Kitchen Staff'];
        foreach ($roles as $r) {
            DB::table('roles')->updateOrInsert(
                ['name' => $r, 'guard_name' => 'web'],
                ['name' => $r, 'guard_name' => 'web']
            );
        }

        $roleIds = DB::table('roles')->pluck('id','name');
        $permIds = DB::table('permissions')->pluck('id','name');

        foreach ($perms as $p) {
            DB::table('role_has_permissions')->updateOrInsert(
                ['permission_id' => $permIds[$p], 'role_id' => $roleIds['Admin']],
                ['permission_id' => $permIds[$p], 'role_id' => $roleIds['Admin']]
            );
        }
        foreach (['orders.view','orders.create','orders.payment','reports.view','staff.manage'] as $p) {
            DB::table('role_has_permissions')->updateOrInsert(
                ['permission_id' => $permIds[$p], 'role_id' => $roleIds['Manager']],
                ['permission_id' => $permIds[$p], 'role_id' => $roleIds['Manager']]
            );
        }
        foreach (['orders.view','orders.create','orders.payment'] as $p) {
            DB::table('role_has_permissions')->updateOrInsert(
                ['permission_id' => $permIds[$p], 'role_id' => $roleIds['Cashier']],
                ['permission_id' => $permIds[$p], 'role_id' => $roleIds['Cashier']]
            );
        }
        foreach (['orders.view'] as $p) {
            DB::table('role_has_permissions')->updateOrInsert(
                ['permission_id' => $permIds[$p], 'role_id' => $roleIds['Kitchen Staff']],
                ['permission_id' => $permIds[$p], 'role_id' => $roleIds['Kitchen Staff']]
            );
        }

        $user = User::first();
        if ($user && isset($roleIds['Admin'])) {
            DB::table('model_has_roles')->updateOrInsert(
                ['role_id' => $roleIds['Admin'], 'model_type' => User::class, 'model_id' => $user->id],
                ['role_id' => $roleIds['Admin'], 'model_type' => User::class, 'model_id' => $user->id]
            );
        }
    }
}
