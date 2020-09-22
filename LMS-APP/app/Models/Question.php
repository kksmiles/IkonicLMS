<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'questions';

    public function quiz()
    {
        return $this->belongsTo('App\Models\Quiz', 'quiz_id', 'id');
    }
    public function options()
    {
        return $this->hasMany('App\Models\Option', 'question_id', 'id');
    }
    public function correct_option()
    {
        return $this->hasOne('App\Models\Option', 'correct_option_id', 'id');
    }
}
