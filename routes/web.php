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

//show login for student,teacher,admin
Route::get('/admin', array('uses' => 'admin@show_login'));
Route::get('/', array('uses' => 'login@show_login'));

Route::middleware(['user_login'])->group(function() {
    Route::get('/student_dashboard/logout', array('uses' => 'login@process_logout'));
    Route::get('/student_dashboard', array('uses' => 'login@show_student_dashboard'));
    Route::get('/teacher/dashboard', array('uses' => 'teacher@dashboard'));
});

Route::middleware(['admin_login_check'])->group(function () {
    Route::get('/admin/admin_dashboard/create_user', array('uses' => 'admin@show_create_user_page'));
    Route::get('/admin/admin_dashboard', array('uses' => 'admin@show_dashboard'));
    Route::post('/admin/admin_dashboard/create_user/proceed', array('uses' => 'admin@do_create_user'))->name('register');
    Route::get('/admin/admin_dashboard/logout', array('uses' => 'admin@do_logout'));
});

//submit form to controller
Route::post('login',array('uses' => 'login@process_login'));
Route::post('/admin/login', array('uses' => 'admin@do_login'))->name('admin_login');