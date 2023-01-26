<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'status',
        'parent_id',
        'deleted_at'
    ];

    protected $hidden = [
        'status',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    const UPLOAD_PATH = "upload/diseases";

    public function media()
    {
        return $this->morphOne(Media::class,'mediable');
    }

    public function scopeActive($query)
    {
        return $query->where("status",true);
    }

    public function scopeOnlyParent($query)
    {
        return $query->whereNull('parent_id')->where('parent_id', null);
    }
    public function scopeOnlyChildren($query)
    {
        return $query->whereNotNull('parent_id')->where('parent_id','!=', null);
    }

    public function scopePublish($query)
    {
        return $query->whereNull('deleted_at')->where('deleted_at', null);
    }

    public function parent()
    {
        return $this->belongsTo(Disease::class, 'parent_id')->publish();
    }

    public function children()
    {
        return $this->hasMany(Disease::class, 'parent_id')->publish();
    }
}
