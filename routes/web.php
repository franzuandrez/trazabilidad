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


Route::get('registro/categoria_clientes','CategoriaClienteController@index')->name('categoria_clientes.index');
Route::get('registro/categoria_clientes/create','CategoriaClienteController@create')->name('categoria_clientes.create');
Route::post('registro/categoria_clientes/create','CategoriaClienteController@store')->name('categoria_clientes.store');
Route::get('registro/categoria_clientes/{id}/edit','CategoriaClienteController@edit')->name('categoria_clientes.edit');
Route::patch('registro/categoria_clientes/{id}','CategoriaClienteController@update')->name('categoria_clientes.update');
Route::get('registro/categoria_clientes/{id}','CategoriaClienteController@show')->name('categoria_clientes.show');
Route::post('registro/categoria_clientes/{id}','CategoriaClienteController@destroy')->name('categoria_clientes.destroy');



Route::get('registro/clientes','ClienteController@index')->name('clientes.index');
Route::get('registro/clientes/create','ClienteController@create')->name('clientes.create');
Route::post('registro/clientes/create','ClienteController@store')->name('clientes.store');
Route::get('registro/clientes/{id}/edit','ClienteController@edit')->name('clientes.edit');
Route::patch('registro/clientes/{id}','ClienteController@update')->name('clientes.update');
Route::get('registro/clientes/{id}','ClienteController@show')->name('clientes.show');


Route::get('registro/localidades','LocalidadController@index')->name('localidades.index');
Route::get('registro/localidades/create','LocalidadController@create')->name('localidades.create');
Route::post('registro/localidades/create','LocalidadController@store')->name('localidades.store');
Route::get('registro/localidades/{id}/edit','LocalidadController@edit')->name('localidades.edit');
Route::patch('registro/localidades/{id}','LocalidadController@update')->name('localidades.update');
Route::get('registro/localidades/{id}','LocalidadController@show')->name('localidades.show');
Route::post('registro/localidades/{id}','LocalidadController@destroy')->name('localidades.destroy');


Route::get('registro/bodegas','BodegaController@index')->name('bodegas.index');
Route::get('registro/bodegas/create','BodegaController@create')->name('bodegas.create');
Route::post('registro/bodegas/create','BodegaController@store')->name('bodegas.store');
Route::get('registro/bodegas/{id}/edit','BodegaController@edit')->name('bodegas.edit');
Route::patch('registro/bodegas/{id}','BodegaController@update')->name('bodegas.update');
Route::get('registro/bodegas/{id}','BodegaController@show')->name('bodegas.show');
Route::post('registro/bodegas/{id}','BodegaController@destroy')->name('bodegas.destroy');
Route::get('registro/bodegas_by_localidad/{localidad}','BodegaController@bodegas_by_localidad')->name('bodegas.by_localidad');


Route::get('registro/sectores','SectorController@index')->name('sectores.index');
Route::get('registro/sectores/create','SectorController@create')->name('sectores.create');
Route::post('registro/sectores/create','SectorController@store')->name('sectores.store');
Route::get('registro/sectores/{id}/edit','SectorController@edit')->name('sectores.edit');
Route::patch('registro/sectores/{id}','SectorController@update')->name('sectores.update');
Route::get('registro/sectores/{id}','SectorController@show')->name('sectores.show');
Route::post('registro/sectores/{id}','SectorController@destroy')->name('sectores.destroy');
Route::get('registro/sectores_by_bodega/{bodega}','SectorController@sectores_by_bodega')->name('sectores.by_bodega');



Route::get('registro/pasillos','PasilloController@index')->name('pasillos.index');
Route::get('registro/pasillos/create','PasilloController@create')->name('pasillos.create');
Route::post('registro/pasillos/create','PasilloController@store')->name('pasillos.store');
Route::get('registro/pasillos/{id}/edit','PasilloController@edit')->name('pasillos.edit');
Route::patch('registro/pasillos/{id}','PasilloController@update')->name('pasillos.update');
Route::get('registro/pasillos/{id}','PasilloController@show')->name('pasillos.show');
Route::post('registro/pasillos/{id}','PasilloController@destroy')->name('pasillos.destroy');
