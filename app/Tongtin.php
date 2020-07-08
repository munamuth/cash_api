<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tongtin extends Model
{
    protected $fillable = ['start_date', 'name', 'amount', 'number_of_play', 'number_of_player', 'description'];
    use SoftDeletes;
    public function GetStatus()
    {
        return $this->hasOne("App\Status", 'id', 'status_id');
    }
}
