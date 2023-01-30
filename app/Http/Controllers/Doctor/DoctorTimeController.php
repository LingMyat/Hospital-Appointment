<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Day;
use App\Models\DoctorTime;
use Illuminate\Http\Request;

class DoctorTimeController extends Controller
{
    //doctorTimeForm
    public function doctorTimeForm(Request $request)
    {
        $days = Day::all();
        return view('Doctor.page.doctor-time.store-form',compact('days'));
    }

    //store
    public function store(Request $request)
    {
        $request->validate([
            'from_time'=>'required',
            'to_time'=>'required',
            'day'=>'required'
        ]);

        DoctorTime::create([
            'from_time'=>$request->from_time,
            'to_time'=>$request->to_time,
            'day_id'=>$request->day
        ]);

        return redirect()->back()->with('success','Successfully added!');
    }
}
