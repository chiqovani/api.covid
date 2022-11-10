<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed country
 * @property int death
 * @property int recovered
 * @property int confirmed
 * @property int country_id
 */

class Statistics extends JsonResource
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
            'id'=>$this->country_id,
            'name'=> $this->country->name,
            'death'=>$this->death,
            'recovered'=>$this->recovered,
            'confirmed'=>$this->confirmed,
            'code'=>$this->country->code,
            'country_id'=>$this->country_id,
        ];
    }
}
