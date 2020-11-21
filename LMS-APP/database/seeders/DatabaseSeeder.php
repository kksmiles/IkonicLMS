<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Department::factory(3)->create();
        // \App\Models\Batch::factory(10)->create();
        // \App\Models\User::factory(10)->create();
        // \App\Models\Course::factory(10)->create();
        // \App\Models\CourseMaterialTopic::factory(10)->create();
        // \App\Models\CourseMaterial::factory(20)->create();
        // \App\Models\Assignment::factory(10)->create();

        DB::table('users')->insert([
            'role' => '1',
            'full_name' => 'Admin John',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);
        DB::table('users')->insert([
            'role' => '2',
            'full_name' => 'Dr. John Smith',
            'username' => 'johnsmith',
            'email' => 'johnsmith@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'image' => '/storage/profiles/user2.jpeg',
        ]);
        DB::table('users')->insert([
            'role' => '2',
            'full_name' => 'Instructor',
            'username' => 'instructor',
            'email' => 'instructor@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'image' => '/storage/profiles/user3.jpeg',
        ]);
        DB::table('users')->insert([
            'role' => '2',
            'full_name' => 'Miss Alice Mary',
            'username' => 'alicemary',
            'email' => 'alicemary@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'image' => '/storage/profiles/user4.jpeg',
        ]);
        DB::table('users')->insert([
            'role' => '2',
            'full_name' => 'Mr. Murphy Danes',
            'username' => 'murphydanes',
            'email' => 'murphydanes@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'image' => '/storage/profiles/user5.jpeg',
        ]);
        DB::table('users')->insert([
            'role' => '3',
            'full_name' => 'Mr. Kaung Khant',
            'username' => 'kaungkhant',
            'email' => 'kaungkhant@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'image' => '/storage/profiles/user1.jpeg',
        ]);
        DB::table('users')->insert([
            'role' => '3',
            'full_name' => 'Mr. Phone Myat Khine',
            'username' => 'phonemyatkhine',
            'email' => 'phonemyatkhine@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'image' => '/storage/profiles/user6.jpeg',
        ]);
        DB::table('users')->insert([
            'role' => '3',
            'full_name' => 'Mr. Student',
            'username' => 'student',
            'email' => 'student@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'image' => '/storage/profiles/user7.jpeg',
        ]);
        

        \App\Models\User::factory(10)->create();
        
        DB::table('users')->insert([
            'role' => '2',
            'full_name' => 'Mr. Franchis Naruto',
            'username' => 'franchisnaruto',
            'email' => 'franchisnaruto@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);
        DB::table('departments')->insert([
            'name' => 'Department of Computer Science',
            'description' => 'Department of Computer Science Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
            'image' => '/storage/departments/department1.jpeg',
        ]);

        DB::table('departments')->insert([
            'name' => 'Department of Computing',
            'description' => 'Department of Computing Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
            'image' => '/storage/departments/department3.jpeg',
        ]);

        DB::table('departments')->insert([
            'name' => 'Department of Information Science',
            'description' => 'Department of Information Science Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
            'image' => '/storage/departments/department2.jpeg',
        ]);

        DB::table('batches')->insert([
            'name' => '1st Batch',
            'description' => 'First batch Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
            'image' => '/storage/batches/batch1.jpeg',
        ]);

        DB::table('batches')->insert([
            'name' => '2nd Batch',
            'description' => 'Second batch Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
            'image' => '/storage/batches/batch2.jpeg',
        ]);

        DB::table('batches')->insert([
            'name' => '3rd Batch',
            'description' => 'Third batch Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
            'image' => '/storage/batches/batch3.jpeg',
        ]);

        DB::table('courses')->insert([
            'department_id' => '1',
            'title' => 'CS-42701 : Mathematical Theory of Game',
            'description' => 'CS-42701 : Mathematical Theory of Game is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
            'start_date' => '2020-10-11',
            'end_date' => '2021-03-21',
            'image' => '/storage/courses/course1.jpeg'
        ]);

        DB::table('courses')->insert([
            'department_id' => '1',
            'title' => 'CS-42702 : Enterprise Management System',
            'description' => 'CS-42702 : Enterprise Management System is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
            'start_date' => '2020-10-11',
            'end_date' => '2021-03-21',
            'image' => '/storage/courses/course2.jpeg'
        ]);

        DB::table('courses')->insert([
            'department_id' => '1',
            'title' => 'CS-42703 : Software Evolution',
            'description' => 'CS-42703 : Software Evolution is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
            'start_date' => '2020-10-11',
            'end_date' => '2021-03-21',
            'image' => '/storage/courses/course3.jpeg'
        ]);

        DB::table('courses')->insert([
            'department_id' => '2',
            'title' => 'CS-42704 : Software Testing',
            'description' => 'CS-42704 : Software Testing is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
            'start_date' => '2020-10-11',
            'end_date' => '2021-03-21',
            'image' => '/storage/courses/course4.jpeg'
        ]);

        DB::table('courses')->insert([
            'department_id' => '3',
            'title' => 'CS-43204 : Data Engineering',
            'description' => 'CS-43204 : Data Engineering is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
            'start_date' => '2020-10-11',
            'end_date' => '2021-03-21',
            'image' => '/storage/courses/course5.jpeg'
        ]);

        DB::table('courses')->insert([
            'department_id' => '3',
            'title' => 'CS-43205 : Data Science',
            'description' => 'CS-43205 : Data Science is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
            'start_date' => '2020-10-11',
            'end_date' => '2021-03-21',
            'image' => '/storage/courses/course6.jpeg'
        ]);

        DB::table('courses')->insert([
            'department_id' => '2',
            'title' => 'CS-4220 : Mobile Developement',
            'description' => 'CS-4220 : Mobile Developement is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
            'start_date' => '2020-10-11',
            'end_date' => '2021-03-21',
            'image' => '/storage/courses/course7.jpeg'
        ]);

        DB::table('instructor_department')->insert([
            'instructor_id' => '2',
            'department_id' => '1',
        ]);
        DB::table('instructor_department')->insert([
            'instructor_id' => '19',
            'department_id' => '1',
        ]);

        DB::table('instructor_department')->insert([
            'instructor_id' => '3',
            'department_id' => '1',
        ]);

        DB::table('instructor_department')->insert([
            'instructor_id' => '4',
            'department_id' => '2',
        ]);

        DB::table('instructor_department')->insert([
            'instructor_id' => '5',
            'department_id' => '3',
        ]);

        DB::table('learner_batch')->insert([
            'learner_id' => '6',
            'batch_id' => '1',
        ]);

        DB::table('learner_batch')->insert([
            'learner_id' => '7',
            'batch_id' => '1',
        ]);

        DB::table('learner_batch')->insert([
            'learner_id' => '8',
            'batch_id' => '1',
        ]);

        DB::table('learner_batch')->insert([
            'learner_id' => '9',
            'batch_id' => '1',
        ]);

        DB::table('learner_batch')->insert([
            'learner_id' => '10',
            'batch_id' => '1',
        ]);

        DB::table('learner_batch')->insert([
            'learner_id' => '11',
            'batch_id' => '2',
        ]);

        DB::table('learner_batch')->insert([
            'learner_id' => '12',
            'batch_id' => '2',
        ]);

        DB::table('learner_batch')->insert([
            'learner_id' => '13',
            'batch_id' => '2',
        ]);

        DB::table('learner_batch')->insert([
            'learner_id' => '14',
            'batch_id' => '2',
        ]);

        DB::table('learner_batch')->insert([
            'learner_id' => '15',
            'batch_id' => '3',
        ]);

        DB::table('learner_batch')->insert([
            'learner_id' => '16',
            'batch_id' => '3',
        ]);

        DB::table('learner_batch')->insert([
            'learner_id' => '17',
            'batch_id' => '3',
        ]);

        DB::table('learner_batch')->insert([
            'learner_id' => '18',
            'batch_id' => '2',
        ]);

        DB::table('instructor_course')->insert([
            'instructor_id' => '2',
            'course_id' => '1',
        ]);
        DB::table('instructor_course')->insert([
            'instructor_id' => '3',
            'course_id' => '1',
        ]);
        DB::table('instructor_course')->insert([
            'instructor_id' => '19',
            'course_id' => '1',
        ]);
        DB::table('instructor_course')->insert([
            'instructor_id' => '2',
            'course_id' => '2',
        ]);
        DB::table('instructor_course')->insert([
            'instructor_id' => '3',
            'course_id' => '2',
        ]);

        DB::table('instructor_course')->insert([
            'instructor_id' => '2',
            'course_id' => '3',
        ]);
        DB::table('instructor_course')->insert([
            'instructor_id' => '4',
            'course_id' => '4',
        ]);
        DB::table('instructor_course')->insert([
            'instructor_id' => '5',
            'course_id' => '5',
        ]);
        DB::table('instructor_course')->insert([
            'instructor_id' => '5',
            'course_id' => '6',
        ]);
        DB::table('instructor_course')->insert([
            'instructor_id' => '2',
            'course_id' => '7',
        ]);
        DB::table('course_material_topics')->insert([
            'course_id' => '1',
            'title' => 'Announcements',
            'hidden' => 0,
        ]);
        DB::table('course_material_topics')->insert([
            'course_id' => '2',
            'title' => 'Announcements',
            'hidden' => 0,
        ]);
        DB::table('course_material_topics')->insert([
            'course_id' => '3',
            'title' => 'Announcements',
            'hidden' => 0,
        ]);
        DB::table('course_material_topics')->insert([
            'course_id' => '1',
            'title' => 'Week 1',
            'hidden' => 0,
        ]);
        DB::table('course_materials')->insert([
            'course_material_topic_id' => '4',
            'title' => 'Introduction to Games',
            'description' => 'Introduction to games Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
            'course_material_file' => '/course-materials/material1.mp4',
        ]);
        DB::table('course_materials')->insert([
            'course_material_topic_id' => '4',
            'title' => 'Introduction to Games',
            'description' => 'Introduction to games Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
            'course_material_file' => '/course-materials/material1.pdf',
        ]);

    }
}
