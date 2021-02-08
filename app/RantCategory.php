<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RantCategory extends Model
{
    use HasFactory;

    public function scopeOrdered($query) {
        return $query->orderBy('name')->get();
    }
    

}
