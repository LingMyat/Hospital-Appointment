<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoomMessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'room_id'=>$this->room_id,
            'message'=>$this->message,
            'sender' => $this->sender_role=='doctor'?new RoomMessageSenderResource($this->doctor):new RoomMessageSenderResource($this->patient),
            'child_messages'=>RoomMessageResource::collection($this->childs),
            'image'=>new MediaResource($this->media)
        ];
    }
}
