<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\DoctorTime;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    //create
    public function create(Request $request,$id)
    {
        $time = DoctorTime::findOrFail($id);
        return view('Patient.Layout.Template.share.modal.appointment-form-modal',compact('time'));
    }
}
