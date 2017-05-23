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

Route::get('/', 'HomeController@homeGraph')->name('home');

//*********Laravel Auth Routes****************
// Authentication Routes
Auth::routes();
Route::get('register/{userid}/verify/{token}', 'Auth\RegisterController@verify');
//*********************************************

// Dashboard
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

// Requests
Route::get('requests/create', 'RequestController@create')->name('requests.create');
Route::post('requests/create', 'RequestController@store')->name('requests.store');
Route::get('requests/{request}/details', 'RequestController@details' )->name('requests.details')->middleware('can:selfOrAdmin');
Route::get('requests/{request}/rating/{rating}', 'RequestController@rating' )->name('requests.rating')->middleware('can:self');
Route::get('requests/{request}/edit', 'RequestController@edit')->name('requests.edit');
Route::post('requests/{request}/edit', 'RequestController@update')->name('requests.update');
Route::delete('requests/{request}', 'RequestController@destroy')->name('requests.destroy')->middleware('can:self');
Route::get('requests/{request}/download', 'RequestController@download')->name('requests.download')->middleware('can:selfOrAdmin');
Route::get('requests', 'RequestController@index' )->name('requests.index')->middleware('can:admin');
Route::post('requests/{request}/complete', 'RequestController@complete')->name('requests.complete')->middleware('can:admin');
Route::post('requests/{request}/refuse', 'RequestController@refuse')->name('requests.refuse')->middleware('can:admin');

//Comment
Route::post('requests/{request}/details/comment', 'CommentController@create')->name('requests.comment')->middleware('can:selfOrAdmin');
Route::post('requests/{request}/details/comment/{comment}/reply', 'CommentController@reply')->name('requests.reply')->middleware('can:selfOrAdmin');


// Users
Route::get('users', 'UserController@index' )->name('users.index');
Route::get('users/{user}/profile', 'UserController@profile')->name('users.profile');
Route::get('users/editProfile', 'UserController@editProfile')->name('users.editProfile')->middleware('can:self');
Route::post('users/editProfile', 'UserController@updateProfile')->name('users.updateProfile')->middleware('can:self');
Route::put('users/editProfile', 'UserController@updatePassword')->name('users.updatePassword')->middleware('can:self');
Route::get('users/create', 'UserController@create')->name('users.create')->middleware('can:admin');
Route::post('users/create', 'UserController@store')->name('users.store')->middleware('can:admin');
Route::get('users/{user}/edit', 'UserController@edit')->name('users.edit')->middleware('can:admin');
Route::post('users/{user}/edit', 'UserController@update')->name('users.update')->middleware('can:admin');
Route::get('users/{user}/block/{block}', 'UserController@block')->name('users.block')->middleware('can:admin');
Route::get('users/{user}/admin/{admin}', 'UserController@admin')->name('users.admin')->middleware('can:admin');