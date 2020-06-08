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
    return view('inicio');
});

Route::get('salon', function () {
    return view('salon');
})->middleware('auth');

Route::get('estudiante', function () {
    return view('estudiante');
})->middleware('auth');

Auth::routes();

Route::resource('estudiantes','EstudianteController')->middleware('auth');
Route::resource('salones','SalonController')->middleware('auth');

Route::get('/home', 'HomeController@index')->name('home');
