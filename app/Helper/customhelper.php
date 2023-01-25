<?php

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
