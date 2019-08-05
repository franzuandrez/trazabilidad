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

Route::get('users','UserController@index')->name('users.index');
Route::get('users/create','UserController@create')->name('users.create');
Route::post('users/create','UserController@store')->name('users.store');
Route::get('users/{id}/edit','UserController@edit')->name('users.edit');
Route::patch('users/{id}','UserController@update')->name('users.update');
Route::post('users/{id}','UserController@destroy')->name('users.destroy');
Route::get('users/{id}','UserController@show')->name('users.show');
Route::get('users/{id}/cambio','UserController@editPassword')->name('users.editPassword');
Route::patch('users/{id}/cambio','UserController@updatePassword')->name('users.updatePass');

Route::get('roles','RoleController@index')->name('roles.index');
Route::get('roles/create','RoleController@create')->name('roles.create');
Route::post('roles/create','RoleController@store')->name('roles.store');
Route::get('roles/{id}/edit','RoleController@edit')->name('roles.edit');
Route::patch('roles/{id}','RoleController@update')->name('roles.update');
Route::delete('roles/{id}','RoleController@destroy')->name('roles.destroy');
Route::get('roles/{id}','RoleController@show')->name('roles.show');

Route::get('registro/proveedores','ProveedorController@index')->name('proveedores.index');
Route::get('registro/proveedores/create','ProveedorController@create')->name('proveedores.create');
Route::post('registro/proveedores/create','ProveedorController@store')->name('proveedores.store');
Route::get('registro/proveedores/{id}/edit','ProveedorController@edit')->name('proveedores.edit');
Route::patch('registro/proveedores/{id}','ProveedorController@update')->name('proveedores.update');
Route::get('registro/proveedores/{id}','ProveedorController@show')->name('proveedores.show');
Route::post('registro/proveedores/{id}','ProveedorController@destroy')->name('proveedores.destroy');


Route::get('registro/presentaciones','PresentacionController@index')->name('presentacion.index');
Route::get('registro/presentaciones/create','PresentacionController@create')->name('presentacion.create');
Route::post('registro/presentaciones/create','PresentacionController@store')->name('presentacion.store');
Route::get('registro/presentaciones/{id}/edit','PresentacionController@edit')->name('presentacion.edit');
Route::patch('registro/presentaciones/{id}','PresentacionController@update')->name('presentacion.update');
Route::get('registro/presentaciones/{id}','PresentacionController@show')->name('presentacion.show');
Route::post('registro/presentaciones/{id}','PresentacionController@destroy')->name('presentacion.destroy');


Route::get('registro/dimensionales','DimensionalController@index')->name('dimensionales.index');
Route::get('registro/dimensionales/create','DimensionalController@create')->name('dimensionales.create');
Route::post('registro/dimensionales/create','DimensionalController@store')->name('dimensionales.store');
Route::get('registro/dimensionales/{id}/edit','DimensionalController@edit')->name('dimensionales.edit');
Route::patch('registro/dimensionales/{id}','DimensionalController@update')->name('dimensionales.update');
Route::get('registro/dimensionales/{id}','DimensionalController@show')->name('dimensionales.show');
Route::post('registro/dimensionales/{id}','DimensionalController@destroy')->name('dimensionales.destroy');