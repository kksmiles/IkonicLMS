<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Assignment extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'assignments';
    public function course_material_topic()
    {
        return $this->belongsTo('App\Models\CourseMaterialTopic', 'course_material_topic_id', 'id');
    }
    public function submissions()
    {
        return $this->hasMany('App\Models\LearnerSubmission', 'assignment_id', 'id');
    }
    public function getFileURL() {
        return $this->assignment_file ? $this->assignment_file : '/img/empty-file.svg';
    }

    public function isOverDue() 
    {
        $now = Carbon::now();
        if($now > $this->due_date)
        {
            return true;
        }
        return false;
    }
}
