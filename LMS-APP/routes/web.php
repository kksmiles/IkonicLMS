<?php

use Illuminate\Support\Facades\Route;

Route::resource('users', 'UserController');
Route::resource('batches', 'BatchController');
Route::resource('departments', 'DepartmentController');
Route::resource('courses', 'CourseController');
Route::resource('course-material-topics', 'CourseMaterialTopicController');
Route::resource('course-materials', 'CourseMaterialController');
Route::resource('assignments', 'AssignmentController');
Route::resource('quizzes', 'QuizController');
Route::resource('questions', 'QuestionController');
Route::resource('options', 'OptionController');


Route::get('/', function () {
    return view('home');
});
Route::get('/dashboard', function () {
    return view('test');
})->name('dashboard');
Route::get('/search', function () {
    return view('test');
})->name('search');
Route::get('/calendar', function () {
    return view('test');
})->name('calendar');

Route::get('/home', function(){
    return view('home');
})->name('home');
