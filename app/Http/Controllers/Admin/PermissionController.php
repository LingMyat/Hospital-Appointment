<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
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

    public function destroy($id)
    {
        Permission::findOrFail($id)->delete();
        return redirect()->route('admin.permissions')->with('success', 'Successfully deleted permission!');
    }
}
