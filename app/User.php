<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'password'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * For routing using {username}
     */
    public function resolveRouteBinding($value)
    {
        return $this->where('username', str_replace('@', '', $value))->firstOrFail();
    }


    public function getOriginalUsernameAttribute() {
        return str_replace('@', '', $this->username);
    }

    public function getShortBioAttribute() {
        return $this->details->bio ? substr($this->details->bio, 0, 10).'...' : 'Some info here';
    }

    public function getNameAttribute() {
        return trim($this->fullname) ? $this->fullname : $this->username;
    }

    public function getFullnameAttribute() {
        if($this->details) {
            return $this->details->first_name .' '. $this->details->last_name;
        }
    }

    public function getUsernameAttribute($value) {
        return '@'.$value;
    }

    public function getAvatarAttribute() {
        return $this->details && $this->details->avatar ? $this->details->avatar : '//placehold.it/100';
    }
    public function getDateJoinedAttribute() {
        return $this->created_at->toDayDateTimeString();
    }


    public function details() {
        return $this->hasOne(UserDetails::class, 'user_id');
    }

    function posts() {
        return $this->hasMany(Post::class, 'user_id');
    }

    function comments() {
        return $this->hasMany(Comment::class, 'user_id');
    }


    function canEditPost($post) {
        return $post->user && ($this->hasRole('moderator') || $this->id == $post->user->id);
    }

    function canEditComment($comment) {

        return $comment->user && ($this->hasRole('moderator') || $this->id == $comment->user->id);
    }

}
