<?php

namespace App\Policies;

use App\Models\CourseMaterialTopic;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CourseMaterialTopicPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->role==1;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CourseMaterialTopic  $courseMaterialTopic
     * @return mixed
     */
    public function view(User $user, CourseMaterialTopic $courseMaterialTopic)
    {
        $course_id = $courseMaterialTopic->course->id;
        if($user->role==1) {
            return true;
        } else if($user->role==2) {
            return !((count($user->instructor_courses->where('id', $course_id)))==0);
        } else {
            return !((count($user->learner_courses->where('id', $course_id)))==0);
        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if($user->role==1) {
            return true;
        } else if($user->role==2) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CourseMaterialTopic  $courseMaterialTopic
     * @return mixed
     */
    public function update(User $user, CourseMaterialTopic $courseMaterialTopic)
    {
        if($user->role==1) {
            return true;
        } else if($user->role==2) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CourseMaterialTopic  $courseMaterialTopic
     * @return mixed
     */
    public function delete(User $user, CourseMaterialTopic $courseMaterialTopic)
    {
        if($user->role==1) {
            return true;
        } else if($user->role==2) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CourseMaterialTopic  $courseMaterialTopic
     * @return mixed
     */
    public function restore(User $user, CourseMaterialTopic $courseMaterialTopic)
    {
        if($user->role==1) {
            return true;
        } else if($user->role==2) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CourseMaterialTopic  $courseMaterialTopic
     * @return mixed
     */
    public function forceDelete(User $user, CourseMaterialTopic $courseMaterialTopic)
    {
        if($user->role==1) {
            return true;
        } else if($user->role==2) {
            return true;
        } else {
            return false;
        }
    }
}
