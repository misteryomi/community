<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Comment extends Model
{

    public $guarded = [];

    public function post() {
        return $this->belongsTo(Post::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Returns the likes on current comment
     */
    public function likes() {
        return $this->hasMany(CommentLike::class, 'comment_id');
    }


    public function getDateAttribute() {
        return $this->created_at->diffInHours() > 25 ? $this->created_at->toDayDateTimeString() : $this->created_at->diffForHumans();
    }

    public function canEdit() {
        return auth()->user() && auth()->user()->canEditComment($this);
    }


    public function liked() {
        return auth()->user() && $this->likes()->where('user_id', auth()->user()->id)->first() ? true : false;
    }

    public function highestCommenters($from, $to) {
        return $this->select('user_id', DB::raw('count(*) as total'))->groupBy('user_id')->orderBy('total', 'desc')->whereBetween('created_at', [$from, $to])->get();
    }
            
}
