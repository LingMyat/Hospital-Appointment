<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Day;
use App\Models\Doctor;
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
            'time_from'=>$request->from_time,
            'time_to'=>$request->to_time,
            'day_id'=>$request->day,
            'doctor_id'=>doctorAuth()->id
        ]);
        return redirect()->back()->with('success','Successfully added!');
    }

    //update
    public function update(Request $request,$id)
    {
        $request->validate([
            'from_time'=>'required',
            'to_time'=>'required',
            'day'=>'required'
        ]);
        DoctorTime::findOrFail($id)->update([
            'time_from'=>$request->from_time,
            'time_to'=>$request->to_time,
            'day_id'=>$request->day,
        ]);
        return redirect()->back()->with('success','Successfully updated!');
    }

    //destroy
    public function destroy(Request $request,$id)
    {
        DoctorTime::findOrFail($id)->delete();
        return redirect()->back()->with('success','Successfully deleted!');
    }
}
