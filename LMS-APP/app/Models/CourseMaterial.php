<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseMaterial extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'course_materials';

    public function course_material_topic()
    {
        return $this->belongsTo('App\Models\CourseMaterialTopic', 'course_material_topic_id', 'id');
    }
    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'course_material_id', 'id');
    }
    public function learner_progress()
    {
        return $this->belongsToMany('App\Models\User', 'learner_progress', 'course_material_id', 'learner_id')->withPivot('completed');
    }
    public function getFileURL() {
        return $this->course_material_file ? $this->course_material_file : '/img/empty-file.svg';
    }
}
