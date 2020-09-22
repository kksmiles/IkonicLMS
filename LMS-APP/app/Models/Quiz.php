<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'quizzes';

    public function course()
    {
        return $this->belongsTo('App\Models\Course', 'course_id', 'id');
    }
    public function questions()
    {
        return $this->hasMany('App\Models\Question', 'quiz_id', 'id');
    }
}
