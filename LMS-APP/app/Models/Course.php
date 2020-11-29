<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Course extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'courses';

    public function learners()
    {
        return $this->belongsToMany('App\Models\User', 'learner_course', 'course_id', 'learner_id')->withPivot('grades');
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
    public function course_materials()
    {
        return $this->hasManyThrough('App\Models\CourseMaterial', 'App\Models\CourseMaterialTopic');
    }

    public function getImageURL() {
        return $this->image ? $this->image : '/img/course-default.svg';
    }
    public function getStatus() 
    {
        $now = Carbon::now();
        $start_date = $this->start_date;
        $end_date = $this->end_date;
        if($now > $end_date)
        {
            return "past";
        }
        else if ($now < $start_date) 
        {
            return "future";
        }
        else if ($now >= $start_date && $now <= $end_date)
        {
            return "present";
        }
    }
}
