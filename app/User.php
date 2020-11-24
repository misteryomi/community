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
        'name', 'email', 'username', 'password', 'google_id'
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
        return $this->where('username', $value)->firstOrFail();
    }


    public function getOriginalUsernameAttribute() {
        return str_replace('@', '', $this->username);
    }

    public function getShortBioAttribute() {
        return $this->details->bio ? substr($this->details->bio, 0, 40).'...' : '';
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


    // Clean username
    public function getCleanUsernameAttribute() {
        return str_replace('@',  '', $this->username);
    }    

    public function getAvatarAttribute() {
        return $this->details && $this->details->avatar ? env('APP_URL').'storage/'.$this->details->avatar : asset('assets/images/avatars/avatar-7.jpg');
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

    function communities() {
        return $this->hasManyThrough(Community::class, FollowedCommunities::class, 'user_id', 'id', 'id', 'community_id');
    }    

    function communitiesTopics() {
        return $this->hasManyThrough(Post::class, FollowedCommunities::class, 'user_id', 'id', 'id', 'community_id');
    }    

    function bookmarkedTopics() {
        return $this->hasManyThrough(Post::class, Bookmark::class, 'user_id', 'id', 'id', 'post_id');
    }    

    function bookmarks() {
        return $this->hasMany(Bookmark::class, 'user_id');
    }

    function likes() {
        return $this->hasMany(PostLike::class, 'user_id');
    }

    public function passwordReset() {
        return $this->hasOne(PasswordReset::class, 'email', 'email');
    }

    public function settings() {
        return $this->hasOne(UserSettings::class, 'user_id');
    }

    function canEditPost($post) {
        return $post->user && ($this->hasRole('moderator') || $this->id == $post->user->id);
    }

    function canDeletePost($post) {
        return $post->user && ($this->hasRole('moderator') || $this->id == $post->user->id);
    }

    function canEditComment($comment) {

        return $comment->user && ($this->hasRole('moderator') || $this->id == $comment->user->id);
    }

}
