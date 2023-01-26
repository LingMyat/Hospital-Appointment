<?php

namespace App\Helper;

use App\Models\Doctor;

class DoctorAuth
{
    public static function login(Doctor $doctor)
    {
        session()->put('doctorLoggedIn', true);
        session()->put('doctorId', $doctor->id);
        session()->put('doctorName', $doctor->name);
        // $doctor->status==false?$doctor->update(['status'=>true]):$doctor;
    }

    public static function logout()
    {
        session()->forget([
            'doctorLoggedIn',
            'doctorId',
            'doctorName'
        ]);
    }

    public static function auth()
    {
        $doctor_id = session('doctorId');
        if (session('doctorId')) {
            return Doctor::findOrFail($doctor_id);
        }

        return false;
    }
}
