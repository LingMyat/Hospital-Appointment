<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
        return [
            "id" => $this->id,
            'image' => $this->image,
            'name' => "Dr. $this->name",
            'SAMA' => $this->SAMA,
            'degree' => $this->degree,
            'specialities' => SubDiseaseResource::collection($this->Specialities),
            'phone' => $this->phone,
            'email' => $this->email,
            'biography' => $this->biography
        ];
    }
}
