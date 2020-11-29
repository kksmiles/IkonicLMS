<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\User' => 'App\Policies\UserPolicy',
        'App\Models\Batch' => 'App\Policies\BatchPolicy',
        'App\Models\Department' => 'App\Policies\DepartmentPolicy',
        'App\Models\SiteData' => 'App\Policies\SiteDataPolicy',
        'App\Models\Course' => 'App\Policies\CoursePolicy',
        'App\Models\CourseMaterial' => 'App\Policies\CourseMaterialPolicy',
        'App\Models\CourseMaterialTopic' => 'App\Policies\CourseMaterialTopicPolicy',
        'App\Models\Comment' => 'App\Policies\CommentPolicy',
        'App\Models\LearnerSubmission' => 'App\Policies\SubmissionPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
