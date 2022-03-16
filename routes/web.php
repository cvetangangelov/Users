<?php

use Illuminate\Support\Facades\Route;

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
/*
Route::get('/', function () {
    return view('users.index');
});
*/
//Auth::routes();
Route::get('users', 'UserController@index')->name('index');

Route::group([
    'name' => 'users',
    'prefix' => 'users',
], function () {

    // URL: /user/profile
    // Route name: user.profile
    Route::get('/','UsersController@index');
    Route::get('insert','UsersController@insertform')->name('users.insert');
    Route::post('insert','UsersController@insert')->name('users.insert');
    Route::get('index','UsersController@index')->name('users.viewall');
    Route::get('index/{id}','UsersController@index')->name('users.viewall');
    Route::get('edit/{id}','UsersController@edit')->name('users.edit');
    Route::post('edit/{id}','UsersController@update')->name('users.edit');
    Route::get('delete/{id}','UsersController@delete')->name('users.delete');
    Route::get('edit/deleteimage/{id}','UsersController@deleteimage')->name('users.edit.deleteimage');
});
/*
Route::get('/','UsersController@index');

Route::get('insert','UsersController@insertform')->name('insertform');
Route::post('insert','UsersController@insert')->name('insert');
Route::get('index','UsersController@index')->name('viewall');
Route::get('index/{id}','UsersController@index')->name('viewall');
Route::get('edit/{id}','UsersController@editform')->name('edit');
Route::post('edit/{id}','UsersController@update')->name('edit');
Route::get('delete/{id}','UsersController@delete')->name('delete');
Route::get('edit/deleteimage/{id}','UsersController@deleteimage')->name('editform');
*/
/*
Route::get('/','ProjectController@index');
Route::get('insert','ProjectController@insertform');
Route::post('insert','ProjectController@insert');
Route::get('viewall','ProjectController@index');
Route::get('viewall/{id}','ProjectController@index');
Route::get('edit/{id}','ProjectController@editform');
Route::post('edit/{id}','ProjectController@update');
Route::get('delete/{id}','ProjectController@delete');
Route::get('edit/deleteimage/{id}','ProjectController@deleteimage');
*/