<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    /**
     * Returns the bookmarks on current post
     */
    public function posts() {
        return $this->hasMany(Posts::class, 'post_id');
    }

    // public function posts() {
    //     return $this->belongsTo(Post::class);
    // }
}
