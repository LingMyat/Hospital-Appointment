<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'disease_id',
        'doctor_time_id',
        'status',
        'cancel_remark',
        'time',
        'note'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class,'patient_id');
    }
    public function scopePatientIn($query,$id)
    {
        return $query->where('patient_id',$id);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class,'doctor_id');
    }
    public function scopeDoctorIn($query,$id)
    {
        return $query->where('doctor_id',$id);
    }

    public function doctorTime()
    {
        return $this->belongsTo(DoctorTime::class,'doctor_time_id');
    }
    public function scopeDoctorTimeIn($query,$id)
    {
        return $query->where('doctor_time_id',$id);
    }

    public function disease()
    {
        return $this->belongsTo(Disease::class,'disease_id');
    }


}
