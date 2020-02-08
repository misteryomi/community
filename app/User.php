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


    public function getNameAttribute() {
        return trim($this->fullname) ? $this->fullname : $this->username;
    }

    public function getFullnameAttribute() {
            return $this->details->first_name .' '. $this->details->last_name;
    }

    public function getUsernameAttribute($value) {
        return '@'.$value;
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
}
