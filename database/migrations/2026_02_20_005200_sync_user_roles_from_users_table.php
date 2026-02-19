<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        $roles = DB::table('roles')->pluck('id','name'); // name => id
        $users = DB::table('users')->select('id','role')->get();
        foreach ($users as $u) {
            $rname = $u->role;
            if (!$rname) continue;
            if (!isset($roles[$rname])) {
                DB::table('roles')->updateOrInsert(
                    ['name' => $rname, 'guard_name' => 'web'],
                    ['name' => $rname, 'guard_name' => 'web']
                );
                $roles = DB::table('roles')->pluck('id','name');
            }
            $rid = $roles[$rname] ?? null;
            if ($rid) {
                $exists = DB::table('model_has_roles')
                    ->where('model_type', 'App\\Models\\User')
                    ->where('model_id', $u->id)
                    ->where('role_id', $rid)
                    ->exists();
                if (!$exists) {
                    DB::table('model_has_roles')->insert([
                        'role_id' => $rid,
                        'model_type' => 'App\\Models\\User',
                        'model_id' => $u->id,
                    ]);
                }
            }
        }
    }

    public function down(): void
    {
        // No rollback necessary
    }
};
