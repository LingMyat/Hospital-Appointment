<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //dashboard
    public function dashboard(Request $request)
    {
        return view('Admin.dashboard');
    }
}
