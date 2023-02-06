<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PatientAppointmentResource extends JsonResource
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
        $text = 'ကျေးဇူးပြုပြီးခဏစောင့်ပါ။ သင့်ချိန်းဆိုမှုကို ယခု ကျွန်ုပ်တို့ စီစစ်နေပါပြီ။';
        if($this->time)
        {
            $time = date('h:i A', strtotime($this->time)-1200);
            $text = "{$this->doctorTime->day->name_mm} $time အရောက်လာရန်။";
        }

        if($this->status == "canceled")
        {
            $text = $this->cancel_remark;
        }

        return [
            'id' => $this->id,
            'status' => $this->status,
            'time' => $time,
            'day' => new DayResource($this->doctorTime->day),
            'diagnosis' => new SubDiseaseResource($this->disease),
            'doctor' => new DoctorInfoResource($this->doctor),
            'text' => $text
        ];
    }
}
