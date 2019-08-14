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



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');

Route::get('users','UserController@index')->name('users.index');
Route::get('users/create','UserController@create')->name('users.create');
Route::post('users/create','UserController@store')->name('users.store');
Route::get('users/{id}/edit','UserController@edit')->name('users.edit');
Route::patch('users/{id}','UserController@update')->name('users.update');
Route::post('users/{id}','UserController@destroy')->name('users.destroy');
Route::get('users/{id}','UserController@show')->name('users.show');
Route::get('users/{id}/cambio','UserController@editPassword')->name('users.editPassword');
Route::patch('users/{id}/cambio','UserController@updatePassword')->name('users.updatePass');
Route::get('logout','UserController@logout')->name('logout');

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
Route::get('registro/proveedores/{id}/productos','ProveedorController@productos')->name('proveedores.productos');
Route::post('registro/proveedores/importar','ProveedorController@importar')->name('proveedores.importar');
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
Route::post('registro/clientes/importar','ClienteController@importar')->name('clientes.importar');


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
Route::get('registro/pasillos_by_sector/{sector}','PasilloController@pasillos_by_sector')->name('pasillos.by_sector');


Route::get('registro/racks','RackController@index')->name('racks.index');
Route::get('registro/racks/create','RackController@create')->name('racks.create');
Route::post('registro/racks/create','RackController@store')->name('racks.store');
Route::get('registro/racks/{id}/edit','RackController@edit')->name('racks.edit');
Route::patch('registro/racks/{id}','RackController@update')->name('racks.update');
Route::get('registro/racks/{id}','RackController@show')->name('racks.show');
Route::post('registro/racks/{id}','RackController@destroy')->name('racks.destroy');
Route::get('registro/racks_by_pasillo/{pasillo}','RackController@racks_by_pasillo')->name('racks.by_pasillo');


Route::get('registro/niveles','NivelController@index')->name('niveles.index');
Route::get('registro/niveles/create','NivelController@create')->name('niveles.create');
Route::post('registro/niveles/create','NivelController@store')->name('niveles.store');
Route::get('registro/niveles/{id}/edit','NivelController@edit')->name('niveles.edit');
Route::patch('registro/niveles/{id}','NivelController@update')->name('niveles.update');
Route::get('registro/niveles/{id}','NivelController@show')->name('niveles.show');
Route::post('registro/niveles/{id}','NivelController@destroy')->name('niveles.destroy');
Route::get('registro/niveles_by_rack/{rack}','NivelController@niveles_by_rack')->name('niveles.by_rack');

Route::get('registro/posiciones','PosicionController@index')->name('posiciones.index');
Route::get('registro/posiciones/create','PosicionController@create')->name('posiciones.create');
Route::post('registro/posiciones/create','PosicionController@store')->name('posiciones.store');
Route::get('registro/posiciones/{id}/edit','PosicionController@edit')->name('posiciones.edit');
Route::patch('registro/posiciones/{id}','PosicionController@update')->name('posiciones.update');
Route::get('registro/posiciones/{id}','PosicionController@show')->name('posiciones.show');
Route::post('registro/posiciones/{id}','PosicionController@destroy')->name('posiciones.destroy');
Route::get('registro/posiciones_by_nivel/{nivel}','PosicionController@posiciones_by_nivel')->name('posiciones.by_nivel');


Route::get('registro/bines','BinController@index')->name('bines.index');
Route::get('registro/bines/create','BinController@create')->name('bines.create');
Route::post('registro/bines/create','BinController@store')->name('bines.store');
Route::get('registro/bines/{id}/edit','BinController@edit')->name('bines.edit');
Route::patch('registro/bines/{id}','BinController@update')->name('bines.update');
Route::get('registro/bines/{id}','BinController@show')->name('bines.show');
Route::post('registro/bines/{id}','BinController@destroy')->name('bines.destroy');

Route::get('registro/productos','ProductoController@index')->name('productos.index');
Route::get('registro/productos/create','ProductoController@create')->name('productos.create');
Route::post('registro/productos/create','ProductoController@store')->name('productos.store');
Route::get('registro/productos/{id}/edit','ProductoController@edit')->name('productos.edit');
Route::patch('registro/productos/{id}','ProductoController@update')->name('productos.update');
Route::get('registro/productos/{id}','ProductoController@show')->name('productos.show');
Route::post('registro/productos/importar','ProductoController@importar')->name('productos.importar');
Route::post('registro/productos/{id}','ProductoController@destroy')->name('productos.destroy');
Route::get('registro/productos/search/{value}','ProductoController@search')->name('productos.search');


Route::get('registro/actividades','ActividadController@index')->name('actividades.index');
Route::get('registro/actividades/create','ActividadController@create')->name('actividades.create');
Route::post('registro/actividades/create','ActividadController@store')->name('actividades.store');
Route::get('registro/actividades/{id}/edit','ActividadController@edit')->name('actividades.edit');
Route::patch('registro/actividades/{id}','ActividadController@update')->name('actividades.update');
Route::get('registro/actividades/{id}','ActividadController@show')->name('actividades.show');
Route::post('registro/actividades/{id}','ActividadController@destroy')->name('actividades.destroy');


Route::get('registro/tipo_movimientos','TipoMovimientoController@index')->name('tipo_movimientos.index');
Route::get('registro/tipo_movimientos/create','TipoMovimientoController@create')->name('tipo_movimientos.create');
Route::post('registro/tipo_movimientos/create','TipoMovimientoController@store')->name('tipo_movimientos.store');
Route::get('registro/tipo_movimientos/{id}/edit','TipoMovimientoController@edit')->name('tipo_movimientos.edit');
Route::patch('registro/tipo_movimientos/{id}','TipoMovimientoController@update')->name('tipo_movimientos.update');
Route::get('registro/tipo_movimientos/{id}','TipoMovimientoController@show')->name('tipo_movimientos.show');
Route::post('registro/tipo_movimientos/{id}','TipoMovimientoController@destroy')->name('tipo_movimientos.destroy');


Route::get('registro/colaboradores','ColaboradorController@index')->name('colaboradores.index');
Route::get('registro/colaboradores/create','ColaboradorController@create')->name('colaboradores.create');
Route::post('registro/colaboradores/create','ColaboradorController@store')->name('colaboradores.store');
Route::get('registro/colaboradores/{id}/edit','ColaboradorController@edit')->name('colaboradores.edit');
Route::patch('registro/colaboradores/{id}','ColaboradorController@update')->name('colaboradores.update');
Route::get('registro/colaboradores/{id}','ColaboradorController@show')->name('colaboradores.show');
Route::post('registro/colaboradores/importar','ColaboradorController@importar')->name('colaboradores.importar');
Route::post('registro/colaboradores/{id}','ColaboradorController@destroy')->name('colaboradores.destroy');

Route::get('recepcion/materia_prima','RecepcionController@index')->name('recepcion.materia_prima.index');

Route::get('recepcion/materia_prima/create','RecepcionController@create')
    ->middleware('permission:role-create')
    ->name('recepcion.materia_prima.create');

Route::post('recepcion/materia_prima/create','RecepcionController@store')->name('recepcion.materia_prima.store');
Route::get('recepcion/materia_prima/{id}','RecepcionController@show')->name('recepcion.materia_prima.show');
Route::get('recepcion/materia_prima/{id}/edit','RecepcionController@edit')->name('recepcion.materia_prima.edit');
Route::patch('recepcion/materia_prima/{id}','RecepcionController@update')->name('recepcion.materia_prima.update');

Route::get('recepcion/transito','RecepcionController@transito')->name('recepcion.transito.index');
Route::get('recepcion/transito/{id}/ingreso','RecepcionController@ingreso_transito')->name('recepcion.transito.ingreso');
Route::patch('recepcion/transito/{id}','RecepcionController@ingresar')->name('recepcion.transito.ingresar');

Route::get('control/chaomin','ChaomeanController@index')->name('chaomin.index');
Route::get('control/chaomin/create','ChaomeanController@create')->name('chaomin.create');
Route::post('control/chaomin/create','ChaomeanController@store')->name('chaomin.store');
Route::get('control/chaomin/{id}/edit','ChaomeanController@edit')->name('chaomin.edit');
Route::patch('control/chaomin/{id}','ChaomeanController@update')->name('chaomin.update');
Route::get('control/chaomin/{id}','ChaomeanController@show')->name('chaomin.show');
Route::post('control/chaomin/{id}','ChaomeanController@destroy')->name('chaomin.destroy');

Route::get('control/mezcla_harina','HarinaController@index')->name('mezcla_harina.index');
Route::get('control/mezcla_harina/create','HarinaController@create')->name('mezcla_harina.create');
Route::post('control/mezcla_harina/create','HarinaController@store')->name('mezcla_harina.store');
Route::get('control/mezcla_harina/{id}/edit','HarinaController@edit')->name('mezcla_harina.edit');
Route::patch('control/mezcla_harina/{id}','HarinaController@update')->name('mezcla_harina.update');
Route::get('control/mezcla_harina/{id}','HarinaController@show')->name('mezcla_harina.show');
Route::post('control/mezcla_harina/{id}','HarinaController@destroy')->name('mezcla_harina.destroy');

Route::get('control/laminado','LaminadoController@index')->name('laminado.index');
Route::get('control/laminado/create','LaminadoController@create')->name('laminado.create');
Route::post('control/laminado/create','LaminadoController@store')->name('laminado.store');
Route::get('control/laminado/{id}/edit','LaminadoController@edit')->name('laminado.edit');
Route::patch('control/laminado/{id}','LaminadoController@update')->name('laminado.update');
Route::get('control/laminado/{id}','LaminadoController@show')->name('laminado.show');
Route::post('control/laminado/{id}','LaminadoController@destroy')->name('laminado.destroy');

Route::get('control/peso_humedo','PesoHumedoController@index')->name('peso_humedo.index');
Route::get('control/peso_humedo/create','PesoHumedoController@create')->name('peso_humedo.create');
Route::post('control/peso_humedo/create','PesoHumedoController@store')->name('peso_humedo.store');
Route::get('control/peso_humedo/{id}/edit','PesoHumedoController@edit')->name('peso_humedo.edit');
Route::patch('control/peso_humedo/{id}','PesoHumedoController@update')->name('peso_humedo.update');
Route::get('control/peso_humedo/{id}','PesoHumedoController@show')->name('peso_humedo.show');
Route::post('control/peso_humedo/{id}','PesoHumedoController@destroy')->name('peso_humedo.destroy');

Route::get('control/peso_seco','PesoSecoController@index')->name('peso_seco.index');
Route::get('control/peso_seco/create','PesoSecoController@create')->name('peso_seco.create');
Route::post('control/peso_seco/create','PesoSecoController@store')->name('peso_seco.store');
Route::get('control/peso_seco/{id}/edit','PesoSecoController@edit')->name('peso_seco.edit');
Route::patch('control/peso_seco/{id}','PesoSecoController@update')->name('peso_seco.update');
Route::get('control/peso_seco/{id}','PesoSecoController@show')->name('peso_seco.show');
Route::post('control/peso_seco/{id}','PesoSecoController@destroy')->name('peso_seco.destroy');

Route::get('control/precocido','PrecocidoController@index')->name('precocido.index');
Route::get('control/precocido/create','PrecocidoController@create')->name('precocido.create');
Route::post('control/precocido/create','PrecocidoController@store')->name('precocido.store');
Route::get('control/precocido/{id}/edit','PrecocidoController@edit')->name('precocido.edit');
Route::patch('control/precocido/{id}','PrecocidoController@update')->name('precocido.update');
Route::get('control/precocido/{id}','PrecocidoController@show')->name('precocido.show');
Route::post('control/precocido/{id}','PrecocidoController@destroy')->name('precocido.destroy');

Route::get('produccion/mezcladora','MezcladoraController@index')->name('mezcladora.index');
Route::get('produccion/mezcladora/create','MezcladoraController@create')->name('mezcladora.create');
Route::post('produccion/mezcladora/create','MezcladoraController@store')->name('mezcladora.store');
Route::get('produccion/mezcladora/{id}/edit','MezcladoraController@edit')->name('mezcladora.edit');
Route::patch('produccion/mezcladora/{id}','MezcladoraController@update')->name('mezcladora.update');
Route::get('produccion/mezcladora/{id}','MezcladoraController@show')->name('mezcladora.show');
Route::post('produccion/mezcladora/{id}','MezcladoraController@destroy')->name('mezcladora.destroy');
