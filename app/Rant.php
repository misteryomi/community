<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;


class Rant extends Model
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

    public function mood() {
        return $this->belongsTo(Mood::class, 'mood_id');
    }

    /**
     * Returns the comments on current post
     */
    public function comments() {
        return $this->hasMany(RantComment::class, 'rant_id');
    }

    /**
     * Returns the views on current post
     */
    public function views() {
        return $this->hasMany(RantView::class, 'rant_id');
    }


    /**
     * Returns the likes on current post
     */
    public function likes() {
        return $this->hasMany(RantLike::class, 'rant_id');
    }


    /**
     * Checks if the post exists
     * @param $rant_id
     * @return collection
     */
    public function checkExists($slug) {
        return $this->where('slug', $slug)->first();
    }

    public function relatedTopics($post) {
        $keywords = explode(' ', $post->title);

        $q = $this->where('mood_id', $post->mood_id)->where(function($query) use ($keywords) {
            foreach($keywords as $keyword) {
                $query->orWhere('title', 'LIKE', '%'.$keyword.'%');
            }    
        })->where('id', '!=', $post->id);


        // return $q;
       return $q->inRandomOrder();
    }

    

    public function getFeaturedImageAttribute($value) {

        // return $this->media->first();
        if($value) {
            return $value;
        } else {
            $images = $this->fetchImages($this->details);

            if(count($images) > 0) {
                $this->update([
                    'featured_image' => $images[0]
                ]);
    
                return $images[0];    
            }
        }

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
        return auth()->user() && auth()->user()->canEditRant($this);
    }

    public function generatePostId() {
        $currentPostCountToday = Self::whereDate('created_at', Carbon::today())->count() + 1;

        return time().uniqid().sprintf("%05s", $currentPostCountToday);
    }

    public function liked() {
        return auth()->user() && $this->likes()->where('user_id', auth()->user()->id)->first() ? true : false;
    }

    // public function bookmarked() {
    //     return auth()->user() && $this->bookmarks()->where('user_id', auth()->user()->id)->first() ? true : false;
    // }


        // Highlight words fin text
    function highlightSearchQuery($text, $word){
        $text = preg_replace('#'. preg_quote($word) .'#i', '<span class="text-warning px-1">\\0</span>', $text);
        return $text;
    }


    private function fetchImages($text, $limit = 1) {
        $htmlDom = new \DOMDocument;


        @$htmlDom->loadHTML($text);
        
        $imageTags = $htmlDom->getElementsByTagName('img');


        // dd(count($imageTags));        
        //Create an array to add extracted images to.
        $extractedImages = array();
        
        //Loop through the image tags that DOMDocument found.

        for ($i=0; $i < $limit; $i++) { 
            $imageTag = $imageTags[$i];

            if($imageTag) {
                //Get the src attribute of the image.
                $imgSrc = $imageTag->getAttribute('src');        
            
                //Add the image details to our $extractedImages array.
                $extractedImages[] = $imgSrc;
            }
        }
        

        //var_dump our array of images.
        return($extractedImages);        
    }}
