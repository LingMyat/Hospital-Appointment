<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Disease;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller
{
    //dashboard
    public function dashboard(Request $request)
    {
        return view('Admin.dashboard');
    }

    //mainDiseases
    public function diseases(Request $request)
    {
        $mainDiseases = Disease::publish()
                        ->onlyParent()
                        ->with('media','children')
                        ->get();
        return view('Admin.nav-section.diseases.mainDiseases.index',compact('mainDiseases'));
    }

    //subDiseases
    public function subDiseases(Request $request)
    {
        $subDiseases = Disease::publish()
                        ->onlyChildren()
                        ->orderBy('id','asc')
                        ->with('media','parent')
                        ->get();
        return view('Admin.nav-section.diseases.subDiseases.index',compact('subDiseases'));
    }

    //permissions
    public function permissions(Request $request)
    {
        $permissions = Permission::all();
        return view('Admin.nav-section.userManagement.permissions.index',compact('permissions'));
    }

    //roles
    public function roles(Request $request)
    {
        if (auth()->user()->hasRole('Superadmin')) {
            $roles =  Role::all();
        } else {
            $roles =  Role::where('name', '!=', 'Superadmin')->get();
        }
        return view('Admin.nav-section.userManagement.roles.index',compact('roles'));
    }

    //users
    public function users(Request $request)
    {
        if (auth()->user()->hasRole('Superadmin')) {
            $users = User::all();
        } else {
            $users = User::whereHas('roles', function ($query) {
                $query->where('name', '!=', 'Superadmin');
            })->get();
        }
        return view('Admin.nav-section.userManagement.users.index', compact('users'));
    }
}
