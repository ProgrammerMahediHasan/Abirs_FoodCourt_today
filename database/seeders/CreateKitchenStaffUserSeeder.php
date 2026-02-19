<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class CreateKitchenStaffUserSeeder extends Seeder
{
    public function run(): void
    {
        $email = 'kitchen@foodcourt.local';
        $user = User::where('email', $email)->first();
        if (!$user) {
            $user = User::create([
                'name' => 'Kitchen Staff',
                'email' => $email,
                'password' => Hash::make('password'),
                'role' => 'Kitchen Staff',
            ]);
        } else {
            $user->update(['role' => 'Kitchen Staff']);
        }
        $role = Role::firstOrCreate(['name' => 'Kitchen Staff', 'guard_name' => 'web']);
        $user->assignRole($role);
    }
}
