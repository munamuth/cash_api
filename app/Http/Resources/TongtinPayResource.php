<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TongtinPayResource extends JsonResource
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
            'date' => $this->date, 
            'tongtin' => $this->GetTongtin, 
            'number_of_claim' => $this->number_of_claim,
            'amount' => $this->amount,
            'total_amount' => $this->total_amount,
        ];
        //return parent::toArray($request);
    }
}
