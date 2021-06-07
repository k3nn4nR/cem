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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/persona','PersonaController@all');
Route::post('/persona','PersonaController@store');
Route::put('/persona','PersonaController@update');
Route::get('/persona-contactos/{persona}','PersonaController@allContactos');
Route::get('/persona-ubicaciones/{persona}','PersonaController@allUbicaciones');
Route::get('/persona-casos/{persona}','PersonaController@allCasos');

Route::post('/contacto','ContactoController@store');
Route::get('/contacto','ContactoController@all');

Route::post('/ubicacion','UbicacionController@store');
Route::get('/ubicacion','UbicacionController@all');