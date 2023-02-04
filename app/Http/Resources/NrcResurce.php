<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NrcResurce extends JsonResource
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
            'name_mm'=>$this->name_mm,
            'nrc_code'=>$this->nrc_code
        ];
    }
}
