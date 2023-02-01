<?php

use App\Models\Doctor;
use App\Models\Patient;

function getStatusBadge($value){
    return $value==true? "<label class='badge badge-success'>Active</label>" : "<label class='badge badge-danger'>Inactive</label>";
}

function getAppointmentStatus($status)
{
    if ($status == 'success') {
        return "<label class='badge badge-success'>Success</label>";
    } elseif ($status == 'canceled') {
        return "<label class='badge badge-danger'>Canceled</label>";
    } else {
        return "<label class='badge badge-primary'>Processing</label>";
    }
}

function patientAuth()
{
    if (session('patientId')) {
        $patient = Patient::active()->where('id', session('patientId'))->get()->first();
        if ($patient) {
            return $patient;
        }
    }

    return false;
}

function doctorAuth()
{
    if (session('doctorId')) {
        $doctor = Doctor::active()->where('id', session('doctorId'))->get()->first();
        if ($doctor) {
            return $doctor;
        }
    }

    return false;
}

function doctorInfo()
{
    $doctor = doctorAuth();
    $arr = [
        $doctor->degree,
        $doctor->SAMA,
        $doctor->biography,
        $doctor->email,
        $doctor->phone,
    ];
    if (in_array(NUll,$arr)) {
        return false;
    }
    return true;
}

function patientAppointmentCheck() {
    $patient = patientAuth();
    $arr = [
        $patient->phone,
        $patient->address,
        $patient->gender,
        $patient->date_of_birth,
    ];
    if (in_array(NUll,$arr)) {
        return false;
    }
    return true;
}


