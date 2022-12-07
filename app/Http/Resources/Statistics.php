<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed owner
 * @property int manufacturer_id
 * @property int model
 * @property string plate_number
 * @property int price
 * @property int id
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
            'id'=>$this->id,
            'price'=>$this->price,
            'model'=>$this->model,
            'plate_number'=>$this->plate_number,
            'personal_number'=>$this->owner->personal_number,
            'phone_number'=>$this->owner->phone_number,
            'mail'=>$this->owner->mail,
            'full_name'=>$this->owner->full_name,
        ];
    }
}
