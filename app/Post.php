<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;

class Post extends Model
{
    protected $guarded = [];


    /**
     * For routing using {slug}
     */
    public function resolveRouteBinding($value)
    {
        return $this->where('slug', $value)->firstOrFail();
    }

    /**
     * Returns owner of this interest
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function tags() {
        return $this->belongsToMany(Tag::class, 'id', 'tag_id');
    }

    /**
     * Returns the comments on current post
     */
    public function comments() {
        return $this->hasMany(Comment::class, 'post_id');
    }

    /**
     * Returns the likes on current post
     */
    public function likes() {
        return $this->hasMany(Like::class, 'post_id');
    }

    public function meta() {
        return $this->hasOne(Meta::class, 'post_id');
    }

    /**
     * Checks if the post exists
     * @param $post_id
     * @return collection
     */
    public function checkExists($slug) {
        return $this->where('slug', $slug)->first();
    }

    public function getExcerptAttribute() {
        return  substr($this->content, 0, 180).'...';
    }

    public function getDateAttribute() {
        return $this->created_at->diffInHours() > 25 ? $this->created_at->toDayDateTimeString() : $this->created_at->diffForHumans();
    }

    public function generatePostId() {
        $currentPostCountToday = Self::whereDate('created_at', Carbon::today())->count() + 1;

        return time().uniqid().sprintf("%05s", $currentPostCountToday);
    }

}
