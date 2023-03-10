<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DoctorTimeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $time_from = date('h:i A', strtotime($this->time_from));
        $time_to = date('h:i A', strtotime($this->time_to));

        return [
            'id' => $this->id,
            'time' => "$time_from - $time_to",
            'day' => $this->day->name,
            'day_mm' => $this->day->name_mm
        ];
    }
}
