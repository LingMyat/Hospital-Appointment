<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'NRC',
        'nrc_id',
        'slug',
        'gender',
        'address',
        'date_of_birth',
        'phone',
        'email',
        'password',
        'status',
        'deleted_at'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    const UPLOAD_PATH = 'upload/patients';

    protected function image():Attribute
    {
        return Attribute::make(
            get: fn ($value) => asset($value),
        );
    }

    protected function password():Attribute
    {
        return Attribute::make(
            set: fn ($value) => Hash::make($value),
        );
    }

    public function scopeActive($query)
    {
        return $query->where("status",true);
    }

    public function nrc()
    {
        return $this->belongsTo(Nrc::class,'nrc_id','id');
    }

}
