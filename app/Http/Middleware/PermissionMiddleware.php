<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PermissionMiddleware
{
    public function handle(Request $request, Closure $next, string $permission)
    {
        $user = Auth::user();
        if (!$user) {
            abort(403);
        }
        $roleIds = DB::table('model_has_roles')
            ->where('model_type', get_class($user))
            ->where('model_id', $user->id)
            ->pluck('role_id')
            ->toArray();
        if (empty($roleIds)) {
            abort(403);
        }
        $permId = DB::table('permissions')
            ->where('name', $permission)
            ->value('id');
        if (!$permId) {
            abort(403);
        }
        $has = DB::table('role_has_permissions')
            ->whereIn('role_id', $roleIds)
            ->where('permission_id', $permId)
            ->exists();
        if (!$has) {
            abort(403);
        }
        return $next($request);
    }
}
