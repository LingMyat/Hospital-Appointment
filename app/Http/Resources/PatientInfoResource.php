<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PatientInfoResource extends JsonResource
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
            'name' => "$this->name",
            'gender' => $this->gender,
            'phone' => $this->phone,
            'address' => $this->address,
            'age' => date_diff(date_create($this->date_of_birth), date_create('now'))->y
        ];
    }
}
