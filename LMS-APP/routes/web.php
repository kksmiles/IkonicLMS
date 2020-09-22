<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// Route::prefix('admin')->group(function () {
//     Route::resource('departments', 'DepartmentController');
//     Route::resource('courses', 'CourseController');
//     Route::resource('course-material-topics', 'CourseMaterialTopicController');
//     Route::resource('course-materials', 'CourseMaterialController');
//     Route::resource('assignments', 'AssignmentController');
//     Route::resource('quizzes', 'QuizController');
// });

// Route::prefix('instructor')->group(function () {
//     Route::resource('course-material-topics', 'CourseMaterialTopicController');
//     Route::resource('course-materials', 'CourseMaterialController');
//     Route::resource('assignments', 'AssignmentController');
//     Route::resource('quizzes', 'QuizController');
// });

Route::resource('departments', 'DepartmentController');
Route::resource('courses', 'CourseController');
Route::resource('course-material-topics', 'CourseMaterialTopicController');
Route::resource('course-materials', 'CourseMaterialController');
Route::resource('assignments', 'AssignmentController');
Route::resource('quizzes', 'QuizController');
Route::resource('questions', 'QuestionController');
Route::resource('options', 'OptionController');
