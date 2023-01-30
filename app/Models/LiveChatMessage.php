<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiveChatMessage extends Model
{
    use HasFactory;
    protected $fillable = [
        'sender_id',
        'sender_role',
        'room_id',
        'message',
        'parent_id'
    ];

    const UPLOAD_PATH = 'upload/messages';

    public function room(){
       return $this->belongsTo(Room::class,'room_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class,'sender_id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class,'sender_id');
    }

    public function scopeRoomIn($query,$roomId)
    {
        return $query->where('room_id',$roomId);
    }
    public function scopeOnlyParent($query)
    {
        return $query->whereNull('parent_id')->where('parent_id', null);
    }
    public function parent()
    {
        return $this->belongsTo(LiveChatMessage::class, 'parent_id');
    }

    public function childs()
    {
        return $this->hasMany(LiveChatMessage::class, 'parent_id');
    }

    public function media()
    {
        return $this->morphOne(Media::class,'mediable');
    }
}
