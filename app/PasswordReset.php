<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    protected $guarded = [];


    /**
     * For routing using {token}
     */
    public function resolveRouteBinding($value)
    {
        return $this->where('token', $value)->firstOrFail();
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

}
