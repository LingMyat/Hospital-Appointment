<?php

namespace App\Http\Controllers\Patient;

use App\Models\Room;
use App\Models\Doctor;
use App\Models\Disease;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

    //doctors
    public function doctors(Request $request)
    {
        $query = Doctor::active()->with('Specialities');
        $doctors = $query->get();
        if ($request->speciality) {
            $disease = Disease::where('slug',$request->speciality)->with('doctors','parent')->get()->first();
            $doctors = $disease->doctors;
        }
        return view('Patient.page.doctors.index',compact('doctors'));
    }

    //chats
    public function chats(Request $request)
    {
        $rooms = Room::active()->get();
        return view('Patient.page.Chat.index',compact('rooms'));
    }
}
