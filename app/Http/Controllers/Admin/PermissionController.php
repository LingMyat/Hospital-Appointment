<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        // $this->middleware('permission:permission-create', ['only' => ['create','store']]);
        // $this->middleware('permission:permission-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
    }
    //create
    public function create(Request $request)
    {
        $roles = Role::all();
        return view('Admin.nav-section.userManagement.permissions.create',compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required|max:40',
        ]);

        $name = $request['name'];
        $permission = Permission::create([
            'name' => $name,
        ]);

        if (!empty($request['roles'])) {
            $roles = $request['roles'];

            foreach ($roles as $role) {
                $r = Role::where('id', '=', $role)->firstOrFail(); //Match input role to db record
                $permission = Permission::where('name', '=', $name)->first();
                $r->givePermissionTo($permission);
            }
        }
        return to_route('admin.permissions')->with('success', 'Successfully created permission!');
    }

    public function edit(Request $request,$id)
    {
        $roles = Role::all();
        $permission = Permission::findOrFail($id);
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.permission_id",$id)
            ->pluck('role_has_permissions.role_id','role_has_permissions.role_id')
            ->all();
        return view('Admin.nav-section.userManagement.permissions.edit', compact('permission', 'roles', 'rolePermissions'));
    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'name'=>'required|max:40',
        ]);

        $permission = Permission::findOrFail($id);
        $name = $request['name'];
        $permission->name = $name;
        $permission->save();

        $permission->syncRoles($request['roles']);
        return to_route('admin.permissions')->with('success', 'Successfully updated permission!');
    }

    public function destroy($id)
    {
        Permission::findOrFail($id)->delete();
        return to_route('admin.permissions')->with('success', 'Successfully deleted permission!');
    }
}
