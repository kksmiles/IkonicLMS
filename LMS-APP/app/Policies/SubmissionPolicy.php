<?php

namespace App\Policies;

use App\Models\LearnerSubmission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubmissionPolicy
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
        return $user->role == 1;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\LearnerSubmission  $learnerSubmission
     * @return mixed
     */
    public function view(User $user, LearnerSubmission $learnerSubmission)
    {
        $course_id = $learnerSubmission->assignment->course_material_topic->course->id;
        if($user->role==1) {
            return true;
        } else if($user->role==2) {
            return !((count($user->instructor_courses->where('id', $course_id)))==0);
        } else {
            return $user->id == $learnerSubmission->learner_id;
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
        if($user->role==3) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\LearnerSubmission  $learnerSubmission
     * @return mixed
     */
    public function update(User $user, LearnerSubmission $learnerSubmission)
    {
        if($user->role==3) {
            return $user->id == $learnerSubmission->learner_id;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\LearnerSubmission  $learnerSubmission
     * @return mixed
     */
    public function delete(User $user, LearnerSubmission $learnerSubmission)
    {
        if($user->role==3) {
            return $user->id == $learnerSubmission->learner_id;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\LearnerSubmission  $learnerSubmission
     * @return mixed
     */
    public function restore(User $user, LearnerSubmission $learnerSubmission)
    {
        if($user->role==3) {
            return $user->id == $learnerSubmission->learner_id;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\LearnerSubmission  $learnerSubmission
     * @return mixed
     */
    public function forceDelete(User $user, LearnerSubmission $learnerSubmission)
    {
        if($user->role==3) {
            return $user->id == $learnerSubmission->learner_id;
        }
        return false;
    }
}
