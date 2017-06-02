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
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Response;
use App\User;

//*********Laravel Auth Routes****************
// Authentication Routes
Auth::routes();
Route::get('register/{userid}/verify/{token}', 'Auth\RegisterController@verify');
//*********************************************

// Dashboard
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

// Search profiles
Route::get('search/profile', function(){
    $input = Input::get('option');
    $users = User::select('id','name')->where('name','LIKE','%'.$input.'%')->take(10)->get();
    return response()->json($users);
});

// Home
Route::get('/', 'HomeController@homeGraph')->name('home');

// Requests
Route::get('requests/create', 'RequestController@create')->name('requests.create');
Route::post('requests/create', 'RequestController@store')->name('requests.store');
Route::get('requests/{request}/details', 'RequestController@details' )->name('requests.details')->middleware('can:selfOrAdmin');
Route::get('requests/{request}/rating/{rating}', 'RequestController@rating' )->name('requests.rating')->middleware('can:self');
Route::get('requests/{request}/edit', 'RequestController@edit')->name('requests.edit');
Route::put('requests/{request}/edit', 'RequestController@update')->name('requests.update');
Route::delete('requests/{request}', 'RequestController@destroy')->name('requests.destroy')->middleware('can:self');
Route::get('requests/{request}/download', 'RequestController@download')->name('requests.download')->middleware('can:selfOrAdmin');
Route::get('requests', 'RequestController@index' )->name('requests.index')->middleware('can:admin');
Route::post('requests/{request}/complete', 'RequestController@complete')->name('requests.complete')->middleware('can:admin');
Route::post('requests/{request}/refuse', 'RequestController@refuse')->name('requests.refuse')->middleware('can:admin');

// Comments
Route::get('comments', 'CommentController@index' )->name('comments.index')->middleware('can:admin');
Route::post('requests/{request}/details/comment', 'CommentController@create')->name('requests.comment')->middleware('can:selfOrAdmin');
Route::post('requests/{request}/details/comment/{comment}/reply', 'CommentController@reply')->name('requests.reply')->middleware('can:selfOrAdmin');
Route::get('requests/comment/{comment}/{block}', 'CommentController@block')->name('comment.block')->middleware('can:admin');

// Users
Route::get('users', 'UserController@index' )->name('users.index');
Route::get('users/blocked', 'UserController@blocked' )->name('users.blocked')->middleware('can:admin');
Route::get('users/{user}/profile', 'UserController@profile')->name('users.profile');
Route::get('users/editProfile', 'UserController@editProfile')->name('users.editProfile')->middleware('can:self');
Route::post('users/editProfile', 'UserController@updateProfile')->name('users.updateProfile')->middleware('can:self');
Route::put('users/editProfile', 'UserController@updatePassword')->name('users.updatePassword')->middleware('can:self');
Route::get('users/{user}/block/{block}', 'UserController@block')->name('users.block')->middleware('can:admin');
Route::get('users/{user}/admin/{admin}', 'UserController@admin')->name('users.admin')->middleware('can:admin');

// Image Crop
Route::get('image/{user}/config', 'ImageController@index')->name('image.config');
Route::post('image/{user}/crop', 'ImageController@crop')->name('image.crop');

// Departments
Route::get('departments', 'DepartmentController@index' )->name('departments.index')->middleware('can:admin');;
Route::get('departments/create', 'DepartmentController@create')->name('departments.create')->middleware('can:admin');;
Route::post('departments/create', 'DepartmentController@store')->name('departments.store')->middleware('can:admin');;
Route::get('departments/{department}/edit', 'DepartmentController@edit')->name('departments.edit')->middleware('can:admin');;
Route::put('departments/{department}/edit', 'DepartmentController@update')->name('departments.update')->middleware('can:admin');

// Printers
Route::get('printers', 'PrinterController@index' )->name('printers.index');
Route::get('printers/create', 'PrinterController@create')->name('printers.create');
Route::post('printers/create', 'PrinterController@store')->name('printers.store');
Route::get('printers/{printer}/edit', 'PrinterController@edit')->name('printers.edit');
Route::put('printers/{printer}/edit', 'PrinterController@update')->name('printers.update');