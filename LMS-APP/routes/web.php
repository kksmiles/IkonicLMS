<?php

use Illuminate\Support\Facades\Route;

Route::resource('users', 'UserController')->middleware('auth');
Route::resource('batches', 'BatchController')->middleware('auth');
Route::post('/batches/users/remove', 'BatchController@removeUser')->middleware('auth')->name('batch-user.detach');
Route::get('/batches/{id}/users/add', 'BatchController@addUser')->middleware('auth')->name('batch-user.add');
Route::post('/batches/{id}/users/store', 'BatchController@storeUser')->middleware('auth')->name('batch-user.store');
Route::resource('departments', 'DepartmentController')->middleware('auth');
Route::post('/departments/users/remove', 'DepartmentController@removeUser')->middleware('auth')->name('department-user.detach');
Route::get('/departments/{id}/users/add', 'DepartmentController@addUser')->middleware('auth')->name('department-user.add');
Route::post('/departments/{id}/users/store', 'DepartmentController@storeUser')->middleware('auth')->name('department-user.store');
Route::resource('courses', 'CourseController')->middleware('auth');
Route::resource('course-material-topics', 'CourseMaterialTopicController')->middleware('auth');
Route::get('course-materials/{id}/check', 'CourseMaterialController@check')->middleware('auth');
Route::get('course-materials/{id}/uncheck', 'CourseMaterialController@unCheck')->middleware('auth');
Route::resource('course-materials', 'CourseMaterialController')->middleware('auth');
Route::resource('assignments', 'AssignmentController')->middleware('auth');
Route::resource('quizzes', 'QuizController')->middleware('auth');
Route::resource('questions', 'QuestionController')->middleware('auth');
Route::resource('options', 'OptionController')->middleware('auth');
Route::resource('comments', 'CommentController')->only(['store', 'destroy'])->middleware('auth');
Route::resource('site-datas', 'SiteDataController');



Route::get('/search', function () {
    return view('test');
})->name('search');
Route::get('/calendar', function () {
    return view('test');
})->name('calendar');

Route::get('/dashboard', 'SiteDataController@dashboard')->name('dashboard');
Route::get('/home', 'SiteDataController@home')->name('home');
Route::get('/', 'SiteDataController@home')->name('home');
