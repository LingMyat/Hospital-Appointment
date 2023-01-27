<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'admin_id',
        'image',
        'deleted_at'
    ];

    const UPLOAD_PATH = 'upload/room';

    public function scopeActive($query)
    {
        return $query->where('active',true);
    }

    protected function image():Attribute
    {
        return Attribute::make(
            get: fn ($value) => asset($value),
        );
    }
}
