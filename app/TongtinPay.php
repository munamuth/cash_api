<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TongtinPay extends Model
{
    protected $fillable = ['date', 'tongtin_id', 'number_of_claim', 'amount', 'total_amount'];

    public function GetTongtin()
    {
        return $this->hasOne("App\Tongtin", 'id', 'tongtin_id');
    }
}
