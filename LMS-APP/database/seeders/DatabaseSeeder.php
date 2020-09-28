<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Department::factory(3)->create();
        \App\Models\Batch::factory(10)->create();
        \App\Models\User::factory(10)->create();
        \App\Models\Course::factory(10)->create();
        \App\Models\CourseMaterialTopic::factory(10)->create();
        \App\Models\CourseMaterial::factory(20)->create();
        \App\Models\Assignment::factory(10)->create();
    }
}
