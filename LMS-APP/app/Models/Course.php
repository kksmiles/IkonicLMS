<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'courses';

    public function learners()
    {
        return $this->belongsToMany('App\Models\User', 'learner_course', 'course_id', 'learner_id');
    }
    public function instructors()
    {
        return $this->belongsToMany('App\Models\User', 'instructor_course', 'course_id', 'instructor_id');
    }
    public function department()
    {
        return $this->belongsTo('App\Models\Department', 'department_id', 'id');
    }
    public function course_material_topics()
    {
        return $this->hasMany('App\Models\CourseMaterialTopic', 'course_id', 'id');
    }
    public function class_periods()
    {
        return $this->hasMany('App\Models\ClassPeriod', 'course_id', 'id');
    }
}
