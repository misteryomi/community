<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCoin extends Model
{
    protected $guarded = [];

    public function getBalanceAttribute($value) {
        return \number_format($value, 2);
    }
}
