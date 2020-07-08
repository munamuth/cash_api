<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TongtinResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'start_date' => $this->start_date,
            'name' => $this->name,
            'amount' => $this->amount,
            'number_of_play' => $this->number_of_play,
            'number_of_player' => $this->number_of_player,
            'status_id' => $this->status_id,
            'status' => $this->GetStatus->name,
            'description' => $this->description,
        ];
        //return parent::toArray($request);
    }
}
