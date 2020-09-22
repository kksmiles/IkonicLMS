<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'courses';

    public function department()
    {
        return $this->belongsTo('App\Models\Department', 'department_id', 'id');
    }
    public function course_material_topics()
    {
        return $this->hasMany('App\Models\CourseMaterialTopic', 'course_id', 'id');
    }
}
