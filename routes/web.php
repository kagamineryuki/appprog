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

//teacher
Route::group(['middleware' => ['user_login:teacher']], function() {
    Route::get('/teacher/teacher_dashboard', array('uses' => 'teacher@show_dashboard'));
    Route::get('/teacher/teacher_dashboard/generate_qr_code', array('uses' => 'teacher@show_generate_qr_code'));
    Route::post('/teacher/teacher_dashboard/generate_qr_code/proceed', array('uses' => 'teacher@generate_qr'));
    Route::get('/teacher/teacher_dashboard/history', array('uses' => 'teacher@show_history'));
    Route::get('/teacher/teacher_dashboard/logout', array('uses' => 'teacher@do_logout'));
});

//student
Route::group(['middleware' => ['user_login:student'] ], function() {
    Route::get('/student/student_dashboard/logout', array('uses' => 'login@process_logout'));
    Route::get('/student/student_dashboard', array('uses' => 'login@show_student_dashboard'));
});

//admin
Route::middleware(['user_login:admin'])->group(function () {
    Route::get('/admin/admin_dashboard/create_user', array('uses' => 'admin@show_create_user_page'));
    Route::get('/admin/admin_dashboard', array('uses' => 'admin@show_dashboard'));
    Route::get('/admin/admin_dashboard/logout', array('uses' => 'admin@do_logout'));

    Route::post('/admin/admin_dashboard/create_user/proceed/create_kelas', array('uses' => 'admin@do_create_kelas'));
    Route::post('/admin/admin_dashboard/create_user/proceed/create_user', array('uses' => 'admin@do_create_user'));
    Route::post('/admin/admin_dashboard/create_user/proceed/create_pelajaran', array('uses' => 'admin@do_create_pelajaran'));
});

//submit form to controller
Route::post('login',array('uses' => 'login@process_login'));
Route::post('/admin/login', array('uses' => 'admin@do_login'))->name('admin_login');