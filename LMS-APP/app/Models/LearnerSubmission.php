<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearnerSubmission extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function learner()
    {
        return $this->belongsTo('App\Models\User', 'learner_id', 'id');
    }

    public function grader()
    {
        return $this->belongsTo('App\Models\User', 'graded_by', 'id');
    }

    public function assignment()
    {
        return $this->belongsTo('App\Models\Assignment', 'assignment_id', 'id');
    }

    public function getFileURL() {
        return $this->submission_file ? $this->submission_file : '/img/empty-file.svg';
    }
}
