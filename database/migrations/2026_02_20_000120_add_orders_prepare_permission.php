<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::table('permissions')->updateOrInsert(
            ['name' => 'orders.prepare', 'guard_name' => 'web'],
            ['name' => 'orders.prepare', 'guard_name' => 'web']
        );
    }

    public function down(): void
    {
        $permId = DB::table('permissions')->where('name', 'orders.prepare')->value('id');
        if ($permId) {
            DB::table('role_has_permissions')->where('permission_id', $permId)->delete();
            DB::table('model_has_permissions')->where('permission_id', $permId)->delete();
            DB::table('permissions')->where('id', $permId)->delete();
        }
    }
};
