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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'StaticPagesController@home')->name('home');
Route::get('/help', 'StaticPagesController@help')->name('help');
Route::get('/about', 'StaticPagesController@about')->name('about');

Route::get('signup', 'UsersController@create')->name('signup');
Route::resource('users', 'UsersController');

// 展示登陆页面
Route::get('login', 'SessionsController@create')->name('login');
// 登陆操作
Route::post('login', 'SessionsController@store')->name('login');
// 退出操作
Route::delete('logout', 'SessionsController@destroy')->name('logout');
// 邮箱验证
Route::get('signup/confirm/{token}', 'UsersController@confirmEmail')->name('confirm_email');

// 重设密码功能的路由
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// 微博状态
Route::resource('statuses', 'StatusesController', ['only' => ['store', 'destroy']]);
