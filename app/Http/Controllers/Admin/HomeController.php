<?php

namespace App\Http\Controllers\Admin;

use App\Models\Disease;
use Illuminate\Http\Request;
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
        $mainDiseases = Disease::onlyParent()
                        ->orderBy('id','desc')
                        ->with('media','children')
                        ->get();
        return view('Admin.nav-section.diseases.mainDiseases.index',compact('mainDiseases'));
    }

    //permissions
    public function permissions(Request $request)
    {
        $permissions = Permission::all();
        return view('Admin.nav-section.userManagement.permissions.index',compact('permissions'));
    }
}
