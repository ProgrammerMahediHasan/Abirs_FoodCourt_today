<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::table('permissions')->updateOrInsert(
            ['name' => 'orders.payment', 'guard_name' => 'web'],
            ['name' => 'orders.payment', 'guard_name' => 'web']
        );
        $permId = DB::table('permissions')->where('name', 'orders.payment')->value('id');
        $roles = DB::table('roles')->whereIn('name', ['Admin','Manager'])->pluck('id','name');
        foreach ($roles as $name => $rid) {
            DB::table('role_has_permissions')->updateOrInsert(
                ['permission_id' => $permId, 'role_id' => $rid],
                ['permission_id' => $permId, 'role_id' => $rid]
            );
        }
    }

    public function down(): void
    {
        $permId = DB::table('permissions')->where('name', 'orders.payment')->value('id');
        if ($permId) {
            DB::table('role_has_permissions')->where('permission_id', $permId)->delete();
            DB::table('model_has_permissions')->where('permission_id', $permId)->delete();
            DB::table('permissions')->where('id', $permId)->delete();
        }
    }
};
