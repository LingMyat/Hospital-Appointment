<?php

namespace App\Http\Resources;

use App\Models\Day;
use Illuminate\Http\Resources\Json\JsonResource;
use PhpParser\Node\Stmt\Foreach_;

class DoctorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $days = Day::with('doctorTimes')->get();
        $times = [];
        foreach($days as $day)
        {
            foreach($day->doctorTimes as $time)
            {
                $time_from = date('h:i A', strtotime($time->time_from));
                $time_to = date('h:i A', strtotime($time->time_to));
                if($time->doctor_id == $this->id)
                {
                    $data = [
                        'id' => $time->id,
                        'time' => "$time_from - $time_to",
                        'day' => $time->day->name,
                        'day_mm' => $time->day->name_mm
                    ];
                    array_push($times,$data);
                }
            }
        }

        return [
            "id" => $this->id,
            'image' => $this->image,
            'name' => "Dr. $this->name",
            'SAMA' => $this->SAMA,
            'degree' => $this->degree,
            'specialities' => SubDiseaseResource::collection($this->Specialities),
            'phone' => $this->phone,
            'email' => $this->email,
            'biography' => $this->biography,
            'role' => $this->role,
            'times' => $times
        ];
    }
}
