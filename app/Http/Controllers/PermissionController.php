<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\RedirectResponse;

class PermissionController extends Controller
{
    public function index()
{
    $permissionsGrouped = Permission::orderBy('module')->get()->groupBy('module');
    $permissions = Permission::orderBy('module')->get();
    return view('admin.permissions.index', compact('permissionsGrouped', 'permissions'));
}


    public function create()
    {
        return view('admin.permissions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name',
            'description' => 'nullable|string',
            'module' => 'required|string',
        ]);

        Permission::create([
            'name' => $request->name,
            'description' => $request->description,
            'module' => $request->module,
            'guard_name' => 'web',
        ]);

        return redirect()->route('permissions.index')->with('success', 'Permiso creado correctamente.');
    }

    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $permission->id,
            'description' => 'nullable|string',
            'module' => 'required|string',
        ]);

        $permission->update([
            'name' => $request->name,
            'description' => $request->description,
            'module' => $request->module,
        ]);

        return redirect()->route('permissions.index')->with('success', 'Permiso actualizado correctamente.');
    }



public function destroy($id): RedirectResponse
{
    Permission::findOrFail($id)->delete();
    return redirect()->route('permissions.index')
                     ->with('mensaje', 'Permiso eliminado correctamente.');
}
}