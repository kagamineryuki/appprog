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

Route::get('/', array('uses' => 'login@show_login'));

Route::get('/teacher/dashboard', ['uses' => 'teacher@dashboard']);

Route::get('/admin/create_user', ['uses' => 'admin@show_register']);

Route::post('/admin/create_user', ['uses' => 'register@do_register'])->name('register');

Route::post('login',array('uses' => 'login@process_login'));