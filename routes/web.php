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
Route::get('registro/proveedores','ProveedorController@index')->name('proveedores.index');
Route::get('registro/proveedores/create','ProveedorController@create')->name('proveedores.create');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('users','UserController@index')->name('users.index');
Route::get('roles','RoleController@index')->name('roles.index');
Route::get('roles/create','RoleController@create')->name('roles.create');
Route::post('roles/create','RoleController@store')->name('roles.store');
