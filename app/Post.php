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


    public function setTitleAttribute($value) {
        $title = '';

        $title_arr = explode(' ', $value);

        foreach($title_arr as $arr) {
                $new_arr = !ctype_upper($arr) ? \ucwords(\strtolower($arr)) : $arr;
                $title .= ' '.$new_arr;
        }
        $this->attributes['title'] = $title;
    }

    /**
     * Returns owner of this interest
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function category() {
        return $this->belongsTo(Community::class, 'community_id');
    }

    public function media() {
        return $this->hasMany(PostMedia::class, 'post_id');
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
     * Returns the views on current post
     */
    public function views() {
        return $this->hasMany(PostView::class, 'post_id');
    }


    /**
     * Returns the likes on current post
     */
    public function likes() {
        return $this->hasMany(Like::class, 'post_id');
    }

    /**
     * Returns the bookmarks on current post
     */
    public function bookmarks() {
        return $this->hasMany(Bookmark::class, 'post_id');
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

    public function relatedTopics() {
        $keywords = explode(' ', $this->title);

        $query = $this;
        
        foreach($keywords as $keyword) {
            $query->orWhere('title', 'LIKE', '%'.$keyword.'%');
        }

        return $query->inRandomOrder();
    }

    

    public function getFeaturedImageAttribute() {
        return $this->media->first();
    }

    public function getExcerptAttribute() {
        return  substr(strip_tags($this->details), 0, 180).'...';
    }

    public function getDateAttribute() {
        return $this->created_at->diffInHours() > 25 ? $this->created_at->toDayDateTimeString() : $this->created_at->diffForHumans();
    }

    public function getPlCommentsAttribute() {
        $comments = $this->comments->count();

        return  $comments.' '.\Str::plural('Comment',  $comments);
    }

    public function getPlViewsAttribute() {
        $views = $this->views->count();

        return  $views.' '.\Str::plural('View',  $views);
    }


    public function canEdit() {
        return auth()->user() && auth()->user()->canEditPost($this);
    }

    public function generatePostId() {
        $currentPostCountToday = Self::whereDate('created_at', Carbon::today())->count() + 1;

        return time().uniqid().sprintf("%05s", $currentPostCountToday);
    }

    public function liked() {
        return auth()->user() && $this->likes()->where('user_id', auth()->user()->id)->first() ? true : false;
    }

    public function bookmarked() {
        return auth()->user() && $this->bookmarks()->where('user_id', auth()->user()->id)->first() ? true : false;
    }


        // Highlight words fin text
    function highlightSearchQuery($text, $word){
        $text = preg_replace('#'. preg_quote($word) .'#i', '<span class="text-warning">\\0</span>', $text);
        return $text;
    }
}
