<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AssignUsersRolesSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::orderBy('id')->take(4)->get();
        if ($users->isEmpty()) return;
        $admin = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
        $manager = Role::firstOrCreate(['name' => 'Manager', 'guard_name' => 'web']);
        $cashier = Role::firstOrCreate(['name' => 'Cashier', 'guard_name' => 'web']);
        $kitchen = Role::firstOrCreate(['name' => 'Kitchen Staff', 'guard_name' => 'web']);
        if (isset($users[0])) { $users[0]->assignRole($admin); $users[0]->update(['role' => 'Admin']); }
        if (isset($users[1])) { $users[1]->assignRole($manager); $users[1]->update(['role' => 'Manager']); }
        if (isset($users[2])) { $users[2]->assignRole($cashier); $users[2]->update(['role' => 'Cashier']); }
        if (isset($users[3])) { $users[3]->assignRole($kitchen); $users[3]->update(['role' => 'Kitchen Staff']); }
    }
}
