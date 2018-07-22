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

Route::get('/', 'NoteController@index');

Auth::routes();

Route::get('/home', 'HomeController@home')->name('home');
Route::group(['middleware' => 'auth'], function () {
	Route::get('/show/{id}/{slug?}', 'NoteController@show')->name('notes.show');
	Route::get('/index', 'HomeController@index')->name('home.index');
	Route::get('/create', 'NoteController@create')->name('notes.create');
	Route::post('/create', 'NoteController@store')->name('notes.store');
	Route::get('/edit/{note}', 'NoteController@edit')->name('notes.edit');
	Route::post('/edit/{note}', 'NoteController@update')->name('notes.update');
	Route::get('/destroy/{note}', 'NoteController@destroy')->name('notes.destroy');
});
Route::get('/{query}', function(){
	return view('not-found');
});
