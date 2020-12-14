<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    public function getNameAttribute($value) {
        if($this->parent()->count() > 0) {
            return $value . ' [' .$this->parent->name . ']';
            // $this->parent->name .' →
        }

        return $value;
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
        return $user && $this->followers->where('user_id', $user->id)->count() > 0;
    }


    public function isRant() {

        $rant_category = $this->where('name', 'rants')->first();

        if($this->where('parent_id', $rant_category->id)->where('id', $this->id)->count()) {
            return true;
        }

        return false;
    }


    public function getExcerptAttribute() {
        return Str::words($this->about, 10);
//        return 'Some text here in few seconds...';
    }


    public function icon($size = 'small') {
        // <div class="icon icon-shape icon-'.$size.' text-white rounded-circle shadow" style="background-color: '.$this->color.'">
        // <div class="p-1 text-dark bg-white icon-border text-white" style="background-color: '.$this->color.'">        
        return '
            <span class="cat-icon">
            '.substr($this->name, 0, 1).'
            </span>
        ';
    }
}
