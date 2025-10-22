<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
public function index()
{
    $roles = Role::with('permissions')->get();
    return view('admin.roles.index', compact('roles'));
}

    public function create()
    {
        $permissions = Permission::orderBy('module')->get();
        return view('admin.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'required|array',
        ]);

        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permissions); // Usa array de names

        return redirect()->route('roles.index')->with('success', 'Rol creado correctamente');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::orderBy('module')->get();
        $role->load('permissions');

        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'permissions' => 'required|array',
        ]);

        $role->syncPermissions($request->permissions); // Usa name

        return redirect()->route('roles.index')->with('success', 'Permisos actualizados correctamente');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Rol eliminado correctamente');
    }

    public function show(Role $role)
{
    $role->load('permissions'); // Carga los permisos
    return view('admin.roles.show', compact('role'));
}

}
