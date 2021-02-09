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
        'name', 'email', 'username', 'password', 'google_id', 'is_active'
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
    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where('username', str_replace('@', '', $value))->firstOrFail();
    }
    // public function getRouteKeyName() {
    //     return 'username';
    // }

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
        //env('APP_URL').'storage/'.
        return $this->details && $this->details->avatar ? $this->details->avatar : '';
        // asset('assets/images/avatars/avatar-7.jpg');
    }
    
    public function getDateJoinedAttribute() {
        return $this->created_at ? $this->created_at->toDayDateTimeString() : '';
    }

    

    public function details() {
        return $this->hasOne(UserDetails::class, 'user_id');
    }

    public function notifications() {
        return $this->hasMany(Notification::class, 'user_id');
    }

    public function coins() {
        return $this->hasOne(UserCoin::class, 'user_id');
    }

    function posts() {
        return $this->hasMany(Post::class, 'user_id');
    }
    
    function rants() {
        return $this->hasMany(Rant::class, 'user_id');
    }

    function comments() {
        return $this->hasMany(Comment::class, 'user_id');
    }

    function communities() {
        return $this->hasMany(Community::class, 'user_id');
    }

    function followedCommunities() {
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

    function canEditRant($rant) {
        return $rant->user && ($this->hasRole('moderator') || $this->id == $rant->user->id);
    }


    function canEditPost($post) {
        //check "can moderate community" first oh
        return $post->user && ($this->hasRole('super-admin') || $this->hasRole('moderator') || $this->id == $post->user->id);
    }

    function canDeletePost($post) {
        return $post->user && ($this->hasRole('moderator') || $this->id == $post->user->id);
    }

    function canEditComment($comment) {

        return $comment->user && ($this->hasRole('moderator') || $this->id == $comment->user->id);
    }

    public function displayAvatar($size = null) {

        if($size == 'sm') {
            $size = 'icon-border-sm';
        }

        if(!$this->avatar) {
            // return '<span class="avatar rounded-circle img-circle bg-secondary text-dark">'.\strtoupper(substr($this->name, 1, 1)).'</span>';
            return '<span class="icon-border  '.$size.' text-center"><i class="uil-user"></i></span>';
            // return "<span class='avatar-img $style'>".\strtoupper(substr($this->name, 1, 1))."</span>";
        }

        return '<img src="'.$this->avatar.'" alt=""/>';
    }


    public function profileRoute() {
        return route('profile.show', ['user' => $this->username ]);
    }
}
