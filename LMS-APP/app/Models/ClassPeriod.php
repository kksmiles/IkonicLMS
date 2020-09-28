<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassPeriod extends Model
{
    use HasFactory;
    protected $table = "class_periods";

    public function instructor()
    {
        return $this->belongsTo('App\Models\User', 'instructor_id', 'id');
    }
    public function course()
    {
        return $this->belongsTo('App\Models\Course', 'course_id', 'id');
    }
    public function learners()
    {
        return $this->belongsToMany('App\Models\User', 'learner_class_period', 'class_period_id', 'learner_id');
    }
}
