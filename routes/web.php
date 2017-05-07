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

Route::get('/', function () {
    return view('welcome');
    });

//*********Laravel Auth Routes****************
// Authentication Routes
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
//*********************************************

// Home Page
Route::get('/home', 'HomeController@index');

// Requests
Route::get('requests', 'RequestController@index' )->name('requests.index');
Route::get('requests/{request}/details', 'RequestController@details' )->name('requests.details');
Route::get('requests/create', 'RequestController@create')->name('requests.create');
Route::post('requests/create', 'RequestController@store')->name('requests.store');
Route::get('requests/{request}/edit', 'RequestController@edit')->name('requests.edit');
Route::post('requests/{request}/edit', 'RequestController@update')->name('requests.update');
Route::delete('requests/{request}', 'RequestController@destroy')->name('requests.destroy');
Route::get('requests/{request}/{status}', 'RequestController@status')->name('requests.status');

// Users
Route::get('users', 'UserController@index' )->name('users.index');
Route::get('users/create', 'UserController@create')->name('users.create');
Route::post('users/create', 'UserController@store')->name('users.store');
Route::get('users/{user}/edit', 'UserController@edit')->name('users.edit');
Route::put('users/{user}/edit', 'UserController@update')->name('users.update');
Route::delete('users/{user}', 'UserController@destroy')->name('users.destroy');