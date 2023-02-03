<?php

namespace App\Http\Controllers\Patient;

use App\Models\Room;
use App\Models\Doctor;
use App\Models\Disease;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Nrc;

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
        $doctors = $query->paginate(6);
        if ($request->speciality) {
            $disease = Disease::where('slug',$request->speciality)->with('doctors','parent')->get()->first();
            $doctors = $disease->doctors;
        }
        return view('Patient.page.doctors.index',compact('doctors'));
    }

    //chats
    public function chats(Request $request)
    {
        $rooms = Room::active()->paginate(6);
        return view('Patient.page.Chat.index',compact('rooms'));
    }

    //profile
    public function profile(Request $request)
    {
        $nrc_codes = Nrc::groupBy('nrc_code')->pluck('nrc_code');
        return view('Patient.page.Profile.profile',compact('nrc_codes'));
    }

    //nrcName
    public function nrcName(Request $request,$nrc_code)
    {
        $nrc_names = Nrc::where('nrc_code',$nrc_code)->get()->pluck('name_mm');
        return view('Patient.Layout.Template.share.modal.nrc-name',compact('nrc_names'));
    }

    //about
    public function about(Request $request)
    {
        return view('Patient.page.about-us');
    }
}
