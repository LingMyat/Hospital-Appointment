<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DoctorTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'time_from',
        'time_to',
        'doctor_id',
        'day_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class,'doctor_id');
    }

    public function day()
    {
        return $this->belongsTo(Day::class,'day_id');
    }

}
