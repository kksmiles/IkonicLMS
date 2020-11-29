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

Route::get('courses/{id}/grades', 'CourseController@indexGrades')->middleware('auth')->name('courses.grades.index');
Route::get('courses/{id}/grades/create', 'CourseController@createGrades')->middleware('auth')->name('courses.grades.create');
Route::post('courses/{id}/grades/store', 'CourseController@storeGrades')->middleware('auth')->name('courses.grades.store');
Route::resource('courses', 'CourseController')->middleware('auth');
Route::post('/courses/learners/remove', 'CourseController@removeLearner')->middleware('auth')->name('course-learner.detach');
Route::get('/courses/{id}/learners/add', 'CourseController@addLearner')->middleware('auth')->name('course-learner.add');
Route::post('/courses/{id}/learners/store', 'CourseController@storeLearner')->middleware('auth')->name('course-learner.store');
Route::post('/courses/instructors/remove', 'CourseController@removeInstructor')->middleware('auth')->name('course-instructor.detach');
Route::get('/courses/{id}/instructors/add', 'CourseController@addInstructor')->middleware('auth')->name('course-instructor.add');
Route::post('/courses/{id}/instructors/store', 'CourseController@storeInstructor')->middleware('auth')->name('course-instructor.store');



Route::resource('course-material-topics', 'CourseMaterialTopicController')->middleware('auth');

Route::get('course-materials/{id}/check', 'CourseMaterialController@check')->middleware('auth');
Route::get('course-materials/{id}/uncheck', 'CourseMaterialController@unCheck')->middleware('auth');
Route::resource('course-materials', 'CourseMaterialController')->middleware('auth');

Route::resource('assignments', 'AssignmentController')->middleware('auth');

Route::get('learner-submissions/feedback/create', 'LearnerSubmissionController@createFeedback')->middleware('auth')->name('submission.feedback.create');
Route::post('learner-submissions/feedback/store', 'LearnerSubmissionController@storeFeedback')->middleware('auth')->name('submission.feedback.store');

Route::resource('learner-submissions', 'LearnerSubmissionController')->except(['index', 'destroy'])->middleware('auth');

Route::resource('comments', 'CommentController')->only(['store', 'destroy'])->middleware('auth');
Route::resource('site-datas', 'SiteDataController');



Route::get('/search', function () {
    return view('test');
})->name('search');
Route::get('/calendar', function () {
    return view('test');
})->name('calendar');

Route::get('/gradebook', 'UserController@gradebook')->name('gradebook');
Route::get('/dashboard', 'SiteDataController@dashboard')->name('dashboard');
Route::get('/home', 'SiteDataController@home')->name('home');
Route::get('/', 'SiteDataController@home')->name('home');
