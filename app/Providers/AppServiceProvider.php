<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */


public function boot()
{
    Paginator::useBootstrap();
    Gate::before(function ($user, $ability) {
        try {
            $stored = strtolower(trim($user->role ?? ''));
            if ($stored === 'admin') {
                if (in_array($ability, ['manage.approve','manage.cancel'])) {
                    return null;
                }
                return true;
            }
            if (method_exists($user, 'hasRole')) {
                    if ($user->hasRole('Admin') || $user->hasRole('admin')) {
                        if (in_array($ability, ['manage.approve','manage.cancel'])) {
                            return null;
                        }
                        return true;
                    }
            }
        } catch (\Throwable $e) {}
        return null;
    });
    Gate::define('manage.basic', function ($user) {
        try {
            $stored = strtolower(trim($user->role ?? ''));
            if ($stored === 'admin') return true;
            if (method_exists($user, 'hasRole')) {
                if ($user->hasRole('Admin')) return true;
            }
        } catch (\Throwable $e) {}
        return false;
    });
    Gate::define('manage.users', function ($user) {
        try {
            $stored = strtolower(trim($user->role ?? ''));
            if ($stored === 'admin') return true;
            if (method_exists($user, 'hasRole') && $user->hasRole('Admin')) return true;
        } catch (\Throwable $e) {}
        return false;
    });
    Gate::define('manage.orders', function ($user) {
        try {
            $stored = strtolower(trim($user->role ?? ''));
            if (in_array($stored, ['admin','manager','cashier'])) return true;
            if (method_exists($user, 'hasRole')) {
                if ($user->hasRole('Admin') || $user->hasRole('Manager') || $user->hasRole('Cashier')) return true;
            }
        } catch (\Throwable $e) {}
        return false;
    });
    Gate::define('manage.customer', function ($user) {
        try {
            $stored = strtolower(trim($user->role ?? ''));
            if (in_array($stored, ['admin','cashier'])) return true;
            if (method_exists($user, 'hasRole')) {
                if ($user->hasRole('Admin') || $user->hasRole('Cashier')) return true;
            }
        } catch (\Throwable $e) {}
        return false;
    });
    Gate::define('manage.payment', function ($user) {
        try {
            $stored = strtolower(trim($user->role ?? ''));
            if (in_array($stored, ['admin','cashier'])) return true;
            if (method_exists($user, 'hasRole')) {
                if ($user->hasRole('Admin') || $user->hasRole('Cashier')) return true;
            }
        } catch (\Throwable $e) {}
        return false;
    });
    Gate::define('manage.approve', function ($user) {
        try {
            $stored = strtolower(trim($user->role ?? ''));
            if (in_array($stored, ['manager'])) return true;
            if (method_exists($user, 'hasRole')) {
                if ($user->hasRole('Manager')) return true;
            }
        } catch (\Throwable $e) {}
        return false;
    });
    Gate::define('manage.cancel', function ($user) {
        try {
            $stored = strtolower(trim($user->role ?? ''));
            if ($stored === 'manager') return true;
            if (method_exists($user, 'hasRole') && $user->hasRole('Manager')) return true;
        } catch (\Throwable $e) {}
        return false;
    });
    if (Auth::check()) {
        try {
            $u = Auth::user();
            if (method_exists($u, 'hasRole') && method_exists($u, 'assignRole')) {
                $storedRole = $u->role ?? null;
                if ($storedRole && !$u->hasRole($storedRole)) {
                    $u->assignRole($storedRole);
                }
            }
        } catch (\Throwable $e) {}
    }
}

}
