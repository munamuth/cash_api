<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use softDeletes;
    protected $fillable = ['date', 'name', 'amount', 'is_loan', 'duration', 'description', 'status_id'];
    public function GetStatus()
    {
        return $this->hasOne("App\Status", 'id', 'status_id');
    }
}
