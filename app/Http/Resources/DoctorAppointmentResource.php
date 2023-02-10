<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DoctorAppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $time_from = date('h:i A', strtotime($this->doctorTime->time_from));
        $time_to = date('h:i A', strtotime($this->doctorTime->time_to));
        $time = "$time_from - $time_to";
        if($this->time)
        {
            $time = date('h:i A', strtotime($this->time));
        }

        return [
            'id' => $this->id,
            'status' => $this->status,
            'time' => $time,
            'day' => new DayResource($this->doctorTime->day),
            'diagnosis' => new SubDiseaseResource($this->disease),
            'patient' => new PatientInfoResource($this->patient),
        ];
    }
}
