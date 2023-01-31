<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;

    public function doctorTimes()
    {
        return $this->hasMany(DoctorTime::class);
    }
}
