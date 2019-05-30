<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/departments', function () {
    return \App\Department::all(['id', 'name as text']);
})->name('api.departments');

Route::get('/professions', function () {
    return \App\Profession::all(['id', 'name as text']);
})->name('api.professions');

Route::get('/classes', function () {
    return \App\Class_::all(['id', 'name as text']);
})->name('api.classes');

Route::get('/class-students/{id}', function ($id) {
    $class = \App\Class_::find($id);
    return $class->students;
})->name('api.class-students');

Route::get('/teachers', function () {
    return \App\Teacher::all(['id','name as text']);
})->name('api.teachers');

Route::get('/students', function (Request $request) {
    if ($request->has('q')) {
        $class = \App\Class_::find($request->get('q', 1));
        if ($class) {
            return $class->students()->select(['id', 'name as text'])->get();
        }

        return [];
    }

    return \App\Student::all(['id', 'name as text']);
})->name('api.students');

Route::get('/courses', function (Request $request) {
    if ($request->has('q')) {
        $student = \App\Student::find($request->get('q', 1));
        if ($student) {
            $class = $student->class_;
            $courses = $class->courses()->select(['courses.id', 'courses.name as text'])->get();
            return $courses;
        }

        return [];
    }

    return \App\Course::all(['id', 'name as text']);
})->name('api.courses');

Route::get('/course-classes/{id}', function ($id) {
    $course = \App\Course::find($id);

    return $course->classes;
})->name('api.course-classes');