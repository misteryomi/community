<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mood extends Model
{
    protected $guarded = [];

    
    public function scopeOrdered($query) {
        return $query->orderBy('name')->get();
    }

    public function getColorAttribute($value) {
        return $value == null ? '#f5365c' : $value;
    }

    public function rants() {
        return $this->hasMany(Rant::class);
    }

    public function children() {
        return $this->hasMany(Self::class, 'parent_id');
    }

    public function parent() {
        return $this->hasOne(Self::class, 'id', 'parent_id');
    }


    public function getExcerptAttribute() {
        return 'Some text here in few seconds...';
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
