<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'assignments';
    public function course_material_topic()
    {
        return $this->belongsTo('App\Models\CourseMaterialTopic', 'course_material_topic_id', 'id');
    }
}
