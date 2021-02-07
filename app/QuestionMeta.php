<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionMeta extends Model
{
    //

    protected $guarded = [];

    public function category() {
        return $this->hasOne(QuestionCategory::class, 'category_id');
    }
}
