<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if( $this->is_loan == 0 )$type = 'Loan';
        else $type = 'Lend';

        return [
            'id' => $this-> id,
            'date' => $this-> date,
             'name'=> $this-> name, 
             'amount'=> $this-> amount, 
             'is_loan'=> $this-> is_loan, 
             'duration'=> $this-> duration, 
             'description'=> $this-> description, 
             'status_id'=> $this-> status_id,
             'type' => $type,
             'status' => $this->GetStatus->name,
        ];
        return parent::toArray($request);
    }
}
