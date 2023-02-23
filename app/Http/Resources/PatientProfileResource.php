<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PatientProfileResource extends JsonResource
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
            'name'=>$this->name,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'date_of_birth' => $this->date_of_birth,
            'image' => $this->image,
            'gender' => $this->gender,
            'address' => $this->address,
            'role' => $this->role,
            'nrc_number'=>$this->NRC,
            'nrc_info'=>new NrcResurce($this->nrc),
        ];
    }
}
