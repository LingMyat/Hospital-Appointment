<?php

namespace App\Helper;

use App\Models\Patient;

class PatientAuth
{
    public static function login(Patient $patient)
    {
        session()->put('LoggedIn', true);
        session()->put('patientId', $patient->id);
        session()->put('patientName', $patient->name);
        // $patient->status==false?$patient->update(['status'=>true]):$patient;
    }

    public static function logout()
    {
        session()->forget([
            'LoggedIn',
            'patientId',
            'patientName'
        ]);
    }

    public static function auth()
    {
        $patient_id = session('patientId');
        if (session('patientId')) {
            return Patient::findOrFail($patient_id);
        }

        return false;
    }
}
