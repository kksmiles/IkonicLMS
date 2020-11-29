<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function departments()
    {
        return $this->belongsToMany('App\Models\Department', 'instructor_department', 'instructor_id', 'department_id');
    }

    public function learner_courses()
    {
        return $this->belongsToMany('App\Models\Course', 'learner_course', 'learner_id', 'course_id')->withPivot('grades');
    }
    public function learner_progress()
    {
        return $this->belongsToMany('App\Models\CourseMaterial', 'learner_progress', 'learner_id', 'course_material_id')->withPivot('completed');
    }
    public function dashboard_courses()
    {
        if(Auth::user()->role==2)
        {
            return $this->belongsToMany('App\Models\Course', 'instructor_course', 'instructor_id', 'course_id');
        } else if (Auth::user()->role==3) {
            return $this->belongsToMany('App\Models\Course', 'learner_course', 'learner_id', 'course_id')->withPivot('grades');
        }
    }
    public function instructor_courses()
    {
        return $this->belongsToMany('App\Models\Course', 'instructor_course', 'instructor_id', 'course_id');
    }

    public function batches()
    {
        return $this->belongsToMany('App\Models\Batch', 'learner_batch', 'learner_id', 'batch_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'user_id', 'id');
    }

    public function instructor_class_periods()
    {
        return $this->hasMany('App\Models\ClassPeriod', 'instructor_id', 'id');
    }

    public function learner_class_periods()
    {
        return $this->belongsToMany('App\Models\ClassPeriod','learner_class_period', 'learner_id', 'class_period_id');
    }

    public function getImageURL() {
        return $this->image ? $this->image : '/img/user-default-avatar.svg';
    }
}
