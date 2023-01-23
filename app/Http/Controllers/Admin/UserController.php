<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create(Request $request)
    {
        if (auth()->user()->hasRole('Superadmin')) {
            $roles = Role::all();
        } else {
            $roles = Role::where('name', '!=', 'Superadmin')->get();
        }

        return view('Admin.nav-section.userManagement.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        if (!empty($request['roles'])) {
            $user->assignRole($request->input('roles'));
        }

        return to_route('admin.users')->with('success', 'Successfully created users!');
    }

    public function edit(Request $request,$id)
    {
        $user = User::findOrFail($id);
        if (auth()->user()->hasRole('Superadmin')) {
            $roles = Role::all();
        } else {
            $roles = Role::where('name', '!=', 'Superadmin')->get();
        }
        $userRole = $user->roles->pluck('id', 'id')->all();

        return view('Admin.nav-section.userManagement.users.edit', compact('user', 'roles', 'userRole'));
    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password'
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::findOrFail($id);
        $user->update($input);
        $user->syncRoles($request->input('roles'));

        return to_route('admin.users')->with('success', 'Sucessfully User Update!');
    }

    public function destroy(Request $request,$id)
    {
        User::findOrFail($id)->delete();
        return to_route('admin.users')->with('success', 'Successfully deleted user!');
    }
}
