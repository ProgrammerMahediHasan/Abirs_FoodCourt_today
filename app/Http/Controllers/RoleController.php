<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $q = Role::query();
        if ($request->filled('search')) {
            $s = trim($request->search);
            $q->where('name', 'like', "%{$s}%");
        }
        $roles = $q->orderBy('id', 'desc')->paginate(10)->appends($request->query());
        return view('pages.erp.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('pages.erp.roles.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255','unique:roles,name'],
        ]);
        Role::create(['name' => $data['name']]);
        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    public function edit(Role $role)
    {
        return view('pages.erp.roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255','unique:roles,name,'.$role->id],
        ]);
        $role->update(['name' => $data['name']]);
        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}
