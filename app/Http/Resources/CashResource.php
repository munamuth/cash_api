<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CashResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if( $this->type == 0){
            $type_name = "Income";
        }
        else{
            $type_name = "Expense";
        }
        return [
            "id" => $this->id,
            "date" => $this->date,
            "name" => $this->name,
            "type" => $this->type,
            "type_name" => $type_name,
            "status_id" => $this->status_id,
            "status_name" => $this->GetStatus->name,
            "amount" => $this->amount,
            "description" => $this->description,
        ];
        //return parent::toArray($request);
    }
}
