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

    public function community() {
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

    public function type() {
        return $this->belongsTo(PostType::class, 'post_type');        
    }


    public function meta() {

        switch ($this->type->name) {
            case 'questions':
                return $this->hasOne(QuestionMeta::class, 'post_id');
            case 'jobs':
                return $this->hasOne(JobMeta::class, 'post_id');
            case 'rants':
                return $this->hasOne(RantMeta::class, 'post_id');
            
            default:
                return $this->hasOne(PostMeta::class, 'post_id');
        }

    }


    public function route($routeName = null) {
        //route(isset($routeName) ? $routeName : 'posts.show', ['post' => $post->slug])
        $type = $this->type ? $this->type->name : 'posts';
        return route($type.'.show', ['post' => $this->slug]);
    }
    /**
     * Checks if the post exists
     * @param $post_id
     * @return collection
     */
    public function checkExists($slug) {
        return $this->where('slug', $slug)->first();
    }

    public function relatedTopics($post) {
        $keywords = explode(' ', $post->title);

        $q = $this->where('community_id', $post->community_id)->where(function($query) use ($keywords) {
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

    // public function getPostTypeAttribute($value) {
    //     return $value == null ? 1 : $value;
    // }

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

    public function canModerate() {
        $user = auth()->user();

        return $user && (($user->can('moderate') && $this->community->moderator_id == $user->id) || $user->hasRole('super-admin'));
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

    public function getPostsType($type) {

        if($type == 'topics') {
           return $this->whereHas('type', function($query) use ($type) {
                        $query->where('name', $type);
                    })->orWhere('post_type', null);
        } else {
            return $this->whereHas('type', function($query) use ($type) {
                $query->where('name', $type);
            });

        }
    }


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
    }
}
