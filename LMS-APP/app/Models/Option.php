<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'quizzes';

    public function question()
    {
        return $this->belongsTo('App\Models\Question', 'question_id', 'id');
    }
}
