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
}
