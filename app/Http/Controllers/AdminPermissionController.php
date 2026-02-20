<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminPermissionController extends Controller
{
    public function index()
    {
        $roles = ['Admin', 'Manager', 'Cashier', 'Kitchen Staff'];
        $modules = [
            ['key' => 'orders.prepare', 'label' => 'Kitchen Prepare'],
            ['key' => 'orders.approve', 'label' => 'Order Approve'],
            ['key' => 'orders.confirm', 'label' => 'Order Confirm/Edit'],
            ['key' => 'orders.cancel', 'label' => 'Order Cancel'],
            ['key' => 'orders.delete', 'label' => 'Order Delete'],
            ['key' => 'payment.process', 'label' => 'Payment'],
            ['key' => 'orders.view', 'label' => 'Invoice'],
            ['key' => 'reports.view', 'label' => 'Reports'],
            ['key' => 'inventory.view', 'label' => 'Inventory'],
            ['key' => 'menus.manage', 'label' => 'Menus'],
            ['key' => 'categories.manage', 'label' => 'Categories'],
            ['key' => 'customer.manage', 'label' => 'Customer'],
            ['key' => 'restaurants.manage', 'label' => 'Restaurants'],
            ['key' => 'tables.manage', 'label' => 'Tables'],
            ['key' => 'stocks.manage', 'label' => 'Stocks'],
        ];
        $matrix = [];
        foreach ($roles as $r) {
            $matrix[$r] = [];
            foreach ($modules as $m) {
                $matrix[$r][$m['key']] = $this->roleHasPermission($r, $m['key']);
            }
        }
        return view('pages.erp.permissions.index', compact('roles', 'modules', 'matrix'));
    }

    public function update(Request $request)
    {
        $this->togglePermission('Manager', 'orders.approve', (bool)$request->boolean('manager_approve'));
        $this->togglePermission('Cashier', 'reports.view', (bool)$request->boolean('cashier_reports'));
        $this->togglePermission('Kitchen Staff', 'inventory.view', (bool)$request->boolean('kitchen_inventory'));

        return redirect()->route('admin.permissions')->with('success', 'Permissions updated');
    }

    public function toggle(Request $request)
    {
        $request->validate([
            'role' => 'required|string',
            'permission' => 'required|string',
            'enable' => 'required|boolean',
        ]);
        $role = $request->input('role');
        $permission = $request->input('permission');
        $enable = (bool)$request->boolean('enable');
        $this->togglePermission($role, $permission, $enable);
        return response()->json(['ok' => true]);
    }

    private function roleHasPermission(string $roleName, string $permName): bool
    {
        $role = Role::where('name', $roleName)->first();
        $perm = Permission::where('name', $permName)->first();
        if (!$role || !$perm) return false;
        return $role->hasPermissionTo($permName);
    }

    private function togglePermission(string $roleName, string $permName, bool $enable): void
    {
        $role = Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
        $perm = Permission::firstOrCreate(['name' => $permName, 'guard_name' => 'web']);
        if ($enable) {
            if (!$role->hasPermissionTo($permName)) $role->givePermissionTo($permName);
        } else {
            if ($role->hasPermissionTo($permName)) $role->revokePermissionTo($permName);
        }
    }
}
