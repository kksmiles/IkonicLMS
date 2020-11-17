<?php

use Illuminate\Support\Facades\Route;

Route::resource('users', 'UserController');
Route::resource('departments', 'DepartmentController');
Route::resource('courses', 'CourseController');
Route::resource('course-material-topics', 'CourseMaterialTopicController');
Route::resource('course-materials', 'CourseMaterialController');
Route::resource('assignments', 'AssignmentController');
Route::resource('quizzes', 'QuizController');
Route::resource('questions', 'QuestionController');
Route::resource('options', 'OptionController');


Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('welcome');
})->name('dashboard');
Route::get('/test', function () {
    return view('test');
});

Route::get('/home', function(){
    return view('home');
});
