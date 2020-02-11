<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Community extends Model
{

    /**
     * For routing using {slug}
     */
    public function resolveRouteBinding($value)
    {
        return $this->where('slug', $value)->firstOrFail();
    }


    public function scopeOrdered($query) {
        return $query->orderBy('name')->get();
    }

    public function getColorAttribute($value) {
        return $value == null ? '#f5365c' : $value;
    }

    public function posts() {
        return $this->hasMany(Post::class);
    }

    public function children() {
        return $this->hasMany(Self::class, 'parent_id');
    }

    public function parent() {
        return $this->hasOne(Self::class, 'id', 'parent_id');
    }

    public function followers() {
        return $this->hasMany(FollowedCommunities::class, 'community_id');
    }

    public function userFollows($user) {
        return $this->followers->where('user_id', $user->id)->count() > 0;
    }


    public function icon($size = 'sm') {
        return '
            <div class="icon icon-shape icon-'.$size.' text-white rounded-circle shadow" style="background-color: '.$this->color.'">
            '.substr($this->name, 0, 1).'
            </div>
        ';
    }
}