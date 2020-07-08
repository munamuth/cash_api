<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Cash extends Model
{
    use SoftDeletes;
    protected $fillable = ['date', 'name', 'type', 'amount', 'description'];
    public function GetStatus()
    {
        return $this->hasOne('App\Status', 'id', 'status_id');
    }
}
