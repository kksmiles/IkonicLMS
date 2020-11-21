<?php

namespace App\Policies;

use App\Models\CourseMaterial;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CourseMaterialPolicy
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
     * @param  \App\Models\CourseMaterial  $courseMaterial
     * @return mixed
     */
    public function view(User $user, CourseMaterial $courseMaterial)
    {
        $course_id = $courseMaterial->course_material_topic->course->id;
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
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CourseMaterial  $courseMaterial
     * @return mixed
     */
    public function update(User $user, CourseMaterial $courseMaterial)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CourseMaterial  $courseMaterial
     * @return mixed
     */
    public function delete(User $user, CourseMaterial $courseMaterial)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CourseMaterial  $courseMaterial
     * @return mixed
     */
    public function restore(User $user, CourseMaterial $courseMaterial)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CourseMaterial  $courseMaterial
     * @return mixed
     */
    public function forceDelete(User $user, CourseMaterial $courseMaterial)
    {
        //
    }
}
