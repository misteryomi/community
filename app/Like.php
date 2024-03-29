<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    public function post() {
        return $this->belongsTo(Post::class);
    }
}
