<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'web'], function () {
    Route::get('login', 'AuthController@showForm')->name('login');
    Route::post('login', 'AuthController@login');
    Route::get('logout', 'AuthController@logout')->name('logout');

    Route::get('/', function (Request $request) {
        if (Auth::guard('teacher')->guest() && Auth::guard('student')->guest()) {
            return redirect(\route('login'));
        }

        if (Auth::guard('teacher')->check()) {
            return redirect(\route('teacher'));
        }
        return redirect(\route('student'));
    });

    # 教师
    Route::group(['prefix' => 'teacher', 'middleware' => 'teacher.auth', 'namespace' => 'Teacher'], function () {
        Route::get('/', 'IndexController@showCourseTable')->name('teacher');

        Route::get('/scores', 'IndexController@showScoreTable')->name('teacher.score');
        Route::post('/scores', 'IndexController@postScore');

        Route::group(['prefix' => 'settings'], function () {
            Route::get('/profile', 'AccountController@showProfileForm')->name('teacher.settings.profile');
            Route::put('/profile', 'AccountController@updateProfile');
            Route::get('/password', 'AccountController@showPasswordForm')->name('teacher.settings.password');
            Route::put('/password', 'AccountController@updatePassword');
        });

    });

    #学生
    Route::group(['prefix' => 'student', 'middleware' => 'student.auth', 'namespace' => 'Student'], function () {
        Route::get('/', 'IndexController@courses')->name('student');
        Route::get('/scores', 'IndexController@scores')->name('student.score');

        Route::group(['prefix' => 'settings'], function () {
            Route::get('/profile', 'AccountController@showProfileForm')->name('student.settings.profile');
            Route::put('/profile', 'AccountController@updateProfile');
            Route::get('/password', 'AccountController@showPasswordForm')->name('student.settings.password');
            Route::put('/password', 'AccountController@updatePassword');
        });

    });
});
