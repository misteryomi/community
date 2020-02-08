<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostView extends Model
{
    protected $guarded = [];

    public $timestamp = ['created_at'];
}
