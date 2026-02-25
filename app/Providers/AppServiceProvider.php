<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Permission;

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
        Permission::firstOrCreate(['name' => 'inventory.view', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'coupons.manage', 'guard_name' => 'web']);
        Gate::before(function ($user, $ability) {
            try {
                $stored = strtolower(trim($user->role ?? ''));
                if ($stored === 'admin') {
                    if (in_array($ability, ['manage.approve', 'manage.cancel'])) {
                        return null;
                    }

                    return true;
                }
                if (method_exists($user, 'hasRole')) {
                    if ($user->hasRole('Admin') || $user->hasRole('admin')) {
                        if (in_array($ability, ['manage.approve', 'manage.cancel'])) {
                            return null;
                        }

                        return true;
                    }
                }
            } catch (\Throwable $e) {
            }

            return null;
        });
        Gate::define('manage.basic', function ($user) {
            try {
                $stored = strtolower(trim($user->role ?? ''));
                if ($stored === 'admin') {
                    return true;
                }
                if (method_exists($user, 'hasRole') && $user->hasRole('Admin')) {
                    return true;
                }
                if (Permission::where('name', 'inventory.view')->where('guard_name', 'web')->exists()) {
                    if (method_exists($user, 'hasPermissionTo') && $user->hasPermissionTo('inventory.view')) {
                        return true;
                    }
                }
            } catch (\Throwable $e) {
            }

            return false;
        });
        Gate::define('manage.users', function ($user) {
            try {
                $stored = strtolower(trim($user->role ?? ''));
                if ($stored === 'admin') {
                    return true;
                }
                if (method_exists($user, 'hasRole') && $user->hasRole('Admin')) {
                    return true;
                }
            } catch (\Throwable $e) {
            }

            return false;
        });
        Gate::define('manage.orders', function ($user) {
            try {
                $stored = strtolower(trim($user->role ?? ''));
                if (in_array($stored, ['admin', 'manager', 'cashier'])) {
                    return true;
                }
                if (method_exists($user, 'hasRole')) {
                    if ($user->hasRole('Admin') || $user->hasRole('Manager') || $user->hasRole('Cashier')) {
                        return true;
                    }
                }
            } catch (\Throwable $e) {
            }

            return false;
        });
        Gate::define('manage.customer', function ($user) {
            try {
                $stored = strtolower(trim($user->role ?? ''));
                if ($stored === 'admin') {
                    return true;
                }
                if (method_exists($user, 'hasRole') && $user->hasRole('Admin')) {
                    return true;
                }
                if (method_exists($user, 'hasPermissionTo') && $user->hasPermissionTo('customer.manage')) {
                    return true;
                }
            } catch (\Throwable $e) {
            }

            return false;
        });
        Gate::define('manage.payment', function ($user) {
            try {
                $stored = strtolower(trim($user->role ?? ''));
                if ($stored === 'admin') {
                    return true;
                }
                if (method_exists($user, 'hasRole') && $user->hasRole('Admin')) {
                    return true;
                }
                if (method_exists($user, 'hasPermissionTo') && $user->hasPermissionTo('payment.process')) {
                    return true;
                }
            } catch (\Throwable $e) {
            }

            return false;
        });
        Gate::define('manage.approve', function ($user) {
            try {
                $stored = strtolower(trim($user->role ?? ''));
                if ($stored === 'manager') {
                    if (method_exists($user, 'hasPermissionTo')) {
                        return $user->hasPermissionTo('orders.approve');
                    }

                    return true;
                }
                if (method_exists($user, 'hasRole') && $user->hasRole('Manager')) {
                    if (method_exists($user, 'hasPermissionTo')) {
                        return $user->hasPermissionTo('orders.approve');
                    }

                    return true;
                }
            } catch (\Throwable $e) {
            }

            return false;
        });
        Gate::define('manage.menus', function ($user) {
            try {
                if (method_exists($user, 'hasPermissionTo') && $user->hasPermissionTo('menus.manage')) {
                    return true;
                }
            } catch (\Throwable $e) {
            }

            return false;
        });
        Gate::define('manage.categories', function ($user) {
            try {
                if (method_exists($user, 'hasPermissionTo') && $user->hasPermissionTo('categories.manage')) {
                    return true;
                }
            } catch (\Throwable $e) {
            }

            return false;
        });
        Gate::define('manage.restaurants', function ($user) {
            try {
                if (method_exists($user, 'hasPermissionTo') && $user->hasPermissionTo('restaurants.manage')) {
                    return true;
                }
            } catch (\Throwable $e) {
            }

            return false;
        });
        Gate::define('manage.tables', function ($user) {
            try {
                if (method_exists($user, 'hasPermissionTo') && $user->hasPermissionTo('tables.manage')) {
                    return true;
                }
            } catch (\Throwable $e) {
            }

            return false;
        });
        Gate::define('manage.stocks', function ($user) {
            try {
                if (method_exists($user, 'hasPermissionTo') && $user->hasPermissionTo('stocks.manage')) {
                    return true;
                }
            } catch (\Throwable $e) {
            }

            return false;
        });
        Gate::define('manage.cancel', function ($user) {
            try {
                $stored = strtolower(trim($user->role ?? ''));
                if (in_array($stored, ['manager', 'admin'])) {
                    return true;
                }
                if (method_exists($user, 'hasRole') && ($user->hasRole('Manager') || $user->hasRole('Admin'))) {
                    return true;
                }
            } catch (\Throwable $e) {
            }

            return false;
        });
        Gate::define('manage.prepare', function ($user) {
            try {
                $stored = strtolower(trim($user->role ?? ''));
                if ($stored === 'kitchen staff' || ($user->hasRole ?? fn () => false)('Kitchen Staff')) {
                    if (method_exists($user, 'hasPermissionTo')) {
                        return $user->hasPermissionTo('orders.prepare');
                    }

                    return false;
                }
                if (method_exists($user, 'hasPermissionTo') && $user->hasPermissionTo('orders.prepare')) {
                    return true;
                }
            } catch (\Throwable $e) {
            }

            return false;
        });
        if (Auth::check()) {
            try {
                $u = Auth::user();
                if (method_exists($u, 'hasRole') && method_exists($u, 'assignRole')) {
                    $storedRole = $u->role ?? null;
                    if ($storedRole && ! $u->hasRole($storedRole)) {
                        $u->assignRole($storedRole);
                    }
                }
            } catch (\Throwable $e) {
            }
        }
    }
}
