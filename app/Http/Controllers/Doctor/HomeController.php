<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Disease;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //dashboard
    public function dashboard(Request $request)
    {
        return view('Doctor.dashboard');
    }

    //profile
    public function profile(Request $request)
    {
        $doctor = doctorAuth();
        $mainDiseases = Disease::publish()
            ->onlyParent()
            ->with('media','children')
            ->active()
            ->get();
        return view('Doctor.auth.profile',compact('doctor','mainDiseases'));
    }
}
