<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', 'TaskController@index');

Auth::routes();

Route::get('/home', 'TaskController@index')->name('home');

Route::resource('task', 'TaskController');
Route::get('/task/completes', 'TaskController@completes')->name('task.completes');
Route::patch('/task/{id}/complete', 'TaskController@complete')->name('task.complete');
