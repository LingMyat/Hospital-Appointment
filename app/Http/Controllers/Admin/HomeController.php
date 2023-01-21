<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Disease;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //dashboard
    public function dashboard(Request $request)
    {
        return view('Admin.dashboard');
    }

    //diseases
    public function diseases(Request $request)
    {
        $mainDiseases = Disease::onlyParent()
                        ->orderBy('id','desc')
                        ->with('media','children')
                        ->get();
        return view('Admin.nav-section.diseases.index',compact('mainDiseases'));
    }
}
