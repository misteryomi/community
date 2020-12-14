<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $guarded = [];


    public function fromUser() {
       return $this->belongsTo(User::class, 'from_id');
    }

    public function getDateAttribute() {
        return $this->created_at->diffInHours() > 25 ? $this->created_at->toDayDateTimeString() : $this->created_at->diffForHumans();
    }

}