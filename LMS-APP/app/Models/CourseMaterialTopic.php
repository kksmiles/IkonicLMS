<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseMaterialTopic extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'course_material_topics';

    public function course()
    {
        return $this->belongsTo('App\Models\Course', 'course_id', 'id');
    }

    public function course_materials()
    {
        return $this->hasMany('App\Models\CourseMaterial', 'course_material_topic_id', 'id');
    }
    public function assignments()
    {
        return $this->hasMany('App\Models\Assignment', 'course_material_topic_id', 'id');
    }
    public function quizzes()
    {
        return $this->hasMany('App\Models\Quiz', 'course_material_topic_id', 'id');
    }
}
