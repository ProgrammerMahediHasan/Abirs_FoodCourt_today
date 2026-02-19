<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRoleController extends Controller
{
    public function update(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|string'
        ]);
        $roleName = $request->input('role');
        $roleId = DB::table('roles')->where('name', $roleName)->value('id');
        if (!$roleId) {
            return back()->withErrors('Invalid role.');
        }
        DB::table('model_has_roles')->where('model_type', User::class)->where('model_id', $user->id)->delete();
        DB::table('model_has_roles')->insert([
            'role_id' => $roleId,
            'model_type' => User::class,
            'model_id' => $user->id
        ]);
        $user->update(['role' => $roleName]);
        return back()->with('success', 'Role updated.');
    }
}
