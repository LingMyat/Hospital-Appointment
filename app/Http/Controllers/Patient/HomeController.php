<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Disease;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //home
    public function home(Request $request)
    {
        $mainDiseases = Disease::publish()
        ->onlyParent()
        ->with('media','children')
        ->active()
        ->get();
        return view('Patient.home',compact('mainDiseases'));
    }
}
