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

Route::get('/', function () {
    return view('home');
});

//Movie
Route::get('/movies', 'MovieController@index')->name('movies.index');
Route::get('/movies/create', 'MovieController@create')->name('movie.create');
Route::post('/movies','MovieController@store')->name('movie.store');
Route::get('/movies/{movie}', 'MovieController@show')->name('movie.show');
Route::get('/movies/{movie}/edit', 'MovieController@edit')->name('movie.edit');
Route::patch('/movies/{movie}', 'MovieController@update')->name('movie.update');
Route::delete('/movies/{movie}', 'MovieController@destroy')->name('movie.destroy');

//Actor
Route::get('/actors', 'ActorController@index')->name('actors.index');
Route::get('/actors/create', 'ActorController@create')->name('actor.create');
Route::post('/actors','ActorController@store')->name('actor.store');
Route::get('/actors/{actor}', 'ActorController@show')->name('actor.show');
Route::get('/actors/{actor}/edit', 'ActorController@edit')->name('actor.edit');
Route::patch('/actors/{actor}', 'ActorController@update')->name('actor.update');
Route::delete('/actors/{actor}', 'ActorController@destroy')->name('actor.destroy');

//Director
Route::get('/directors', 'FilmDirectorController@index')->name('directors.index');
Route::get('/directors/create', 'FilmDirectorController@create')->name('director.create');
Route::post('/directors','FilmDirectorController@store')->name('director.store');
Route::get('/directors/{filmDirector}', 'FilmDirectorController@show')->name('director.show');
Route::get('/directors/{filmDirector}/edit', 'FilmDirectorController@edit')->name('director.edit');
Route::patch('/directors/{filmDirector}', 'FilmDirectorController@update')->name('director.update');
Route::delete('/directors/{filmDirector}', 'FilmDirectorController@destroy')->name('director.destroy');

