<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'departments';
    
    public function courses()
    {
        return $this->hasMany('App\Models\Course', 'department_id', 'id');
    }

    public function instructors()
    {
        return $this->belongsToMany('App\Models\User', 'instructor_department', 'department_id', 'instructor_id');
    }
}
