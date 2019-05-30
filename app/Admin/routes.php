<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix' => config('admin.route.prefix'),       // admin
    'namespace' => config('admin.route.namespace'), //App\\Admin\\Controllers
    'middleware' => config('admin.route.middleware'), //
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');

    $router->resource('departments', 'DepartmentController');
    $router->resource('professions', 'ProfessionController');
    $router->resource('classes', 'ClassController');
    $router->resource('teachers', 'TeacherController');
    $router->resource('students', 'StudentController');
    $router->resource('courses', 'CourseController');
    $router->resource('class-courses', 'ClassCoursesController');
    $router->resource('scores', 'ScoreController');

});
