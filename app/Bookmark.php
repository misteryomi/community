<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    public function post() {
        return $this->belongsTo(User::class);
    }
}
