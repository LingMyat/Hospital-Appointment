<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function create(Request $request)
    {
        if (auth()->user()->hasRole('Superadmin')) {
            $permissions = Permission::all();
        } else {
            $role = Role::findByName('Superadmin');
            $permissions = Permission::whereNotIn('id', $role->permissions()->pluck('permissions.id'))->get();
        }

        return view('Admin.nav-section.userManagement.roles.create',compact('permissions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        if (!empty($request['permissions'])) {
            $role->syncPermissions($request->input('permissions'));
        }

        return to_route('admin.roles')->with('success', 'Successfully created role!');
    }

    public function edit(Request $request,$id)
    {
        if (auth()->user()->hasRole('Superadmin')) {
            $permissions = Permission::all();
        } else {
            $role = Role::findByName('Superadmin');
            $permissions = Permission::whereNotIn('id', $role->permissions()->pluck('permissions.id'))->get();
        }

        $role = Role::findOrFail($id);
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return view('Admin.nav-section.userManagement.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $role = Role::findOrFail($id);
        $role->name = $request->input('name');
        $role->save();

        if (!empty($request['permissions'])) {
            $role->syncPermissions($request->input('permissions'));
        }
        return to_route('admin.roles')->with('success', 'Successfully updated role!!');
    }

    public function destroy(Request $request,$id)
    {
        Role::findOrFail($id)->delete();
        return to_route('admin.roles')->with('success', 'Successfully deleted role!');
    }
}
