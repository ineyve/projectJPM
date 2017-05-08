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
use Illuminate\Support\Facades\Route;

/*Route::get('/', function () {
    return view('welcome');
    });*/
Route::get('/', 'StatisticsController@index');

//*********Laravel Auth Routes****************
// Authentication Routes
Auth::routes();
/*
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login')->middleware('can:guest');
Route::post('login', 'Auth\LoginController@login')->middleware('can:guest');
Route::post('logout', 'Auth\LoginController@logout')->name('logout')->middleware('guest');

// Registration Routes
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register')->middleware('guest');
Route::post('register', 'Auth\RegisterController@register')->middleware('guest');

// Password Reset Routes
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request')->middleware('guest');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email')->middleware('guest');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset')->middleware('guest');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->middleware('guest');
//*********************************************
*/

// Home Page
Route::get('/home', 'HomeController@index')->middleware('can:user');

// Requests
Route::get('requests', 'RequestController@index' )->name('requests.index')->middleware('can:admin');
Route::get('requests/{request}/details', 'RequestController@details' )->name('requests.details')->middleware('can:admin');
Route::get('requests/create', 'RequestController@create')->name('requests.create')->middleware('can:admin');
Route::post('requests/create', 'RequestController@store')->name('requests.store')->middleware('can:admin');
Route::get('requests/{request}/edit', 'RequestController@edit')->name('requests.edit')->middleware('can:admin');
Route::post('requests/{request}/edit', 'RequestController@update')->name('requests.update')->middleware('can:admin');
Route::delete('requests/{request}', 'RequestController@destroy')->name('requests.destroy')->middleware('can:admin');
Route::get('requests/{request}/{status}/{from}', 'RequestController@status')->name('requests.status')->middleware('can:admin');

// Users
Route::get('users', 'UserController@index' )->name('users.index')->middleware('can:admin');
Route::get('users/create', 'UserController@create')->name('users.create')->middleware('can:admin');
Route::post('users/create', 'UserController@store')->name('users.store')->middleware('can:admin');
Route::get('users/{user}/edit', 'UserController@edit')->name('users.edit')->middleware('can:admin');
Route::put('users/{user}/edit', 'UserController@update')->name('users.update')->middleware('can:admin');
Route::delete('users/{user}', 'UserController@destroy')->name('users.destroy')->middleware('can:admin');