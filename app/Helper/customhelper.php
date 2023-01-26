<?php

use App\Models\Doctor;
use App\Models\Patient;

function getStatusBadge($value){
    return $value==true? "<label class='badge badge-success'>Active</label>" : "<label class='badge badge-danger'>Inactive</label>";
}

function patientAuth()
{
    if (session('patientId')) {
        $patient = Patient::active()->where('id', session('patientId'))->get()->first();
        if ($patient) {
            return $patient;
        }
    }

    return null;
}

function doctorAuth()
{
    if (session('doctorId')) {
        $doctor = Doctor::active()->where('id', session('doctorId'))->get()->first();
        if ($doctor) {
            return $doctor;
        }
    }

    return null;
}

function doctorInfo()
{
    $doctor = doctorAuth();
    if ($doctor->degree == Null) {
        return false;
    }
    return true;
}
