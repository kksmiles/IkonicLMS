<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'batches';
    
    public function learners()
    {
        return $this->belongsToMany('App\Models\User', 'learner_batch', 'batch_id', 'learner_id');
    }
}
