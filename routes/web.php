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
Route::get('/personas','PersonaController@maestro');
Route::post('/persona','PersonaController@store');
Route::put('/persona','PersonaController@update');
Route::get('/persona-contactos/{persona}','PersonaController@allContactos');
Route::get('/persona-ubicaciones/{persona}','PersonaController@allUbicaciones');
Route::get('/persona-casos/{persona}','PersonaController@allCasos');

Route::get('/detalle','DetalleCasoController@all');

Route::get('/seguimiento','SeguimientoController@all');
Route::get('/seguimientos','SeguimientoController@maestro');
Route::post('/seguimiento','SeguimientoController@store');

Route::post('/contacto','ContactoController@store');
Route::get('/contacto','ContactoController@all');
Route::put('/contacto','ContactoController@update');

Route::post('/ubicacion','UbicacionController@store');
Route::get('/ubicacion','UbicacionController@all');
Route::put('/ubicacion','UbicacionController@update');

Route::get('/caso','CasoController@all');
Route::get('/casos','CasoController@maestro');
Route::post('/caso','CasoController@store');
Route::put('/caso','CasoController@update');
Route::get('/caso/{ficha}','CasoController@show');


Route::get('/personal','PersonalController@all');
Route::get('/el_personal','PersonalController@maestro');
Route::post('/personal','PersonalController@store');
Route::put('/personal','PersonalController@update');
Route::delete('/personal','PersonalController@destroy');