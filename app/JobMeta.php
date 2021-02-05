<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobMeta extends Model
{
    //
    protected $guarded = [];

    public function category() {
        return $this->hasOne(JobCategory::class, 'id', 'category_id');
    }

    public function type() {
        return $this->hasOne(JobType::class, 'id', 'type_id');
    }

    public function salaryType() {
        return $this->hasOne(JobSalaryType::class, 'id', 'salary_type_id');
    }

    public function locations() {
        return $this->select('location')->where('location', '!=', null)->groupBy('location')->get();
    }
}
