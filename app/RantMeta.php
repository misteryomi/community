<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RantMeta extends Model
{
    //

    protected $guarded = [];

    public function category() {
        return $this->hasOne(RantCategory::class, 'category_id');
    }
}
