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

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');

Route::get('users', 'UserController@index')
    ->middleware('permission:administrar')
    ->name('users.index');

Route::get('users/create', 'UserController@create')
    ->middleware('permission:role-create')
    ->middleware('permission:administrar')
    ->name('users.create');

Route::post('users/create', 'UserController@store')
    ->middleware('permission:role-create')
    ->middleware('permission:administrar')
    ->name('users.store');

Route::get('users/{id}/edit', 'UserController@edit')
    ->middleware('permission:role-edit')
    ->middleware('permission:administrar')
    ->name('users.edit');

Route::patch('users/{id}', 'UserController@update')
    ->middleware('permission:role-edit')
    ->middleware('permission:administrar')
    ->name('users.update');


Route::post('users/{id}', 'UserController@destroy')
    ->middleware('permission:role-delete')
    ->middleware('permission:administrar')
    ->name('users.destroy');

Route::get('users/{id}', 'UserController@show')
    ->middleware('permission:role-list')
    ->middleware('permission:administrar')
    ->name('users.show');


Route::get('users/{id}/cambio', 'UserController@editPassword')
    ->name('users.editPassword');
Route::patch('users/{id}/cambio', 'UserController@updatePassword')->name('users.updatePass');
Route::get('logout', 'UserController@logout')->name('logout');

Route::post('users/verificar/permisos', 'UserController@verificar')
    ->name('users.verificar');

Route::get('roles', 'RoleController@index')->name('roles.index');
Route::get('roles/create', 'RoleController@create')->name('roles.create');
Route::post('roles/create', 'RoleController@store')->name('roles.store');
Route::get('roles/{id}/edit', 'RoleController@edit')->name('roles.edit');
Route::patch('roles/{id}', 'RoleController@update')->name('roles.update');
Route::delete('roles/{id}', 'RoleController@destroy')->name('roles.destroy');
Route::get('roles/{id}', 'RoleController@show')->name('roles.show');

Route::get('registro/proveedores', 'ProveedorController@index')->name('proveedores.index');
Route::get('registro/proveedores/create', 'ProveedorController@create')->name('proveedores.create');
Route::post('registro/proveedores/create', 'ProveedorController@store')->name('proveedores.store');
Route::get('registro/proveedores/{id}/edit', 'ProveedorController@edit')->name('proveedores.edit');
Route::patch('registro/proveedores/{id}', 'ProveedorController@update')->name('proveedores.update');
Route::get('registro/proveedores/{id}', 'ProveedorController@show')->name('proveedores.show');
Route::get('registro/proveedores/{id}/productos', 'ProveedorController@productos')->name('proveedores.productos');
Route::post('registro/proveedores/importar', 'ProveedorController@importar')->name('proveedores.importar');
Route::post('registro/proveedores/{id}', 'ProveedorController@destroy')->name('proveedores.destroy');


Route::get('registro/presentaciones', 'PresentacionController@index')->name('presentacion.index');
Route::get('registro/presentaciones/create', 'PresentacionController@create')->name('presentacion.create');
Route::post('registro/presentaciones/create', 'PresentacionController@store')->name('presentacion.store');
Route::get('registro/presentaciones/{id}/edit', 'PresentacionController@edit')->name('presentacion.edit');
Route::patch('registro/presentaciones/{id}', 'PresentacionController@update')->name('presentacion.update');
Route::get('registro/presentaciones/{id}', 'PresentacionController@show')->name('presentacion.show');
Route::post('registro/presentaciones/{id}', 'PresentacionController@destroy')->name('presentacion.destroy');


Route::get('registro/dimensionales', 'DimensionalController@index')->name('dimensionales.index');
Route::get('registro/dimensionales/create', 'DimensionalController@create')->name('dimensionales.create');
Route::post('registro/dimensionales/create', 'DimensionalController@store')->name('dimensionales.store');
Route::get('registro/dimensionales/{id}/edit', 'DimensionalController@edit')->name('dimensionales.edit');
Route::patch('registro/dimensionales/{id}', 'DimensionalController@update')->name('dimensionales.update');
Route::get('registro/dimensionales/{id}', 'DimensionalController@show')->name('dimensionales.show');
Route::post('registro/dimensionales/{id}', 'DimensionalController@destroy')->name('dimensionales.destroy');


Route::get('registro/categoria_clientes', 'CategoriaClienteController@index')->name('categoria_clientes.index');
Route::get('registro/categoria_clientes/create', 'CategoriaClienteController@create')->name('categoria_clientes.create');
Route::post('registro/categoria_clientes/create', 'CategoriaClienteController@store')->name('categoria_clientes.store');
Route::get('registro/categoria_clientes/{id}/edit', 'CategoriaClienteController@edit')->name('categoria_clientes.edit');
Route::patch('registro/categoria_clientes/{id}', 'CategoriaClienteController@update')->name('categoria_clientes.update');
Route::get('registro/categoria_clientes/{id}', 'CategoriaClienteController@show')->name('categoria_clientes.show');
Route::post('registro/categoria_clientes/{id}', 'CategoriaClienteController@destroy')->name('categoria_clientes.destroy');


Route::get('registro/clientes', 'ClienteController@index')->name('clientes.index');
Route::get('registro/clientes/create', 'ClienteController@create')->name('clientes.create');
Route::post('registro/clientes/create', 'ClienteController@store')->name('clientes.store');
Route::get('registro/clientes/{id}/edit', 'ClienteController@edit')->name('clientes.edit');
Route::patch('registro/clientes/{id}', 'ClienteController@update')->name('clientes.update');
Route::get('registro/clientes/{id}', 'ClienteController@show')->name('clientes.show');
Route::post('registro/clientes/importar', 'ClienteController@importar')->name('clientes.importar');


Route::get('registro/localidades', 'LocalidadController@index')->name('localidades.index');
Route::get('registro/localidades/create', 'LocalidadController@create')->name('localidades.create');
Route::post('registro/localidades/create', 'LocalidadController@store')->name('localidades.store');
Route::get('registro/localidades/{id}/edit', 'LocalidadController@edit')->name('localidades.edit');
Route::patch('registro/localidades/{id}', 'LocalidadController@update')->name('localidades.update');
Route::get('registro/localidades/{id}', 'LocalidadController@show')->name('localidades.show');
Route::post('registro/localidades/{id}', 'LocalidadController@destroy')->name('localidades.destroy');


Route::get('registro/bodegas', 'BodegaController@index')->name('bodegas.index');
Route::get('registro/bodegas/create', 'BodegaController@create')->name('bodegas.create');
Route::post('registro/bodegas/create', 'BodegaController@store')->name('bodegas.store');
Route::get('registro/bodegas/{id}/edit', 'BodegaController@edit')->name('bodegas.edit');
Route::patch('registro/bodegas/{id}', 'BodegaController@update')->name('bodegas.update');
Route::get('registro/bodegas/{id}', 'BodegaController@show')->name('bodegas.show');
Route::post('registro/bodegas/{id}', 'BodegaController@destroy')->name('bodegas.destroy');
Route::get('registro/bodegas_by_localidad/{localidad}', 'BodegaController@bodegas_by_localidad')->name('bodegas.by_localidad');


Route::get('registro/sectores', 'SectorController@index')->name('sectores.index');
Route::get('registro/sectores/create', 'SectorController@create')->name('sectores.create');
Route::post('registro/sectores/create', 'SectorController@store')->name('sectores.store');
Route::get('registro/sectores/{id}/edit', 'SectorController@edit')->name('sectores.edit');
Route::patch('registro/sectores/{id}', 'SectorController@update')->name('sectores.update');
Route::get('registro/sectores/{id}', 'SectorController@show')->name('sectores.show');
Route::post('registro/sectores/{id}', 'SectorController@destroy')->name('sectores.destroy');
Route::get('registro/sectores_by_bodega/{bodega}', 'SectorController@sectores_by_bodega')->name('sectores.by_bodega');


Route::get('registro/pasillos', 'PasilloController@index')->name('pasillos.index');
Route::get('registro/pasillos/create', 'PasilloController@create')->name('pasillos.create');
Route::post('registro/pasillos/create', 'PasilloController@store')->name('pasillos.store');
Route::get('registro/pasillos/{id}/edit', 'PasilloController@edit')->name('pasillos.edit');
Route::patch('registro/pasillos/{id}', 'PasilloController@update')->name('pasillos.update');
Route::get('registro/pasillos/{id}', 'PasilloController@show')->name('pasillos.show');
Route::post('registro/pasillos/{id}', 'PasilloController@destroy')->name('pasillos.destroy');
Route::get('registro/pasillos_by_sector/{sector}', 'PasilloController@pasillos_by_sector')->name('pasillos.by_sector');


Route::get('registro/racks', 'RackController@index')->name('racks.index');
Route::get('registro/racks/create', 'RackController@create')->name('racks.create');
Route::post('registro/racks/create', 'RackController@store')->name('racks.store');
Route::get('registro/racks/{id}/edit', 'RackController@edit')->name('racks.edit');
Route::patch('registro/racks/{id}', 'RackController@update')->name('racks.update');
Route::get('registro/racks/{id}', 'RackController@show')->name('racks.show');
Route::post('registro/racks/{id}', 'RackController@destroy')->name('racks.destroy');
Route::get('registro/racks_by_pasillo/{pasillo}', 'RackController@racks_by_pasillo')->name('racks.by_pasillo');


Route::get('registro/niveles', 'NivelController@index')->name('niveles.index');
Route::get('registro/niveles/create', 'NivelController@create')->name('niveles.create');
Route::post('registro/niveles/create', 'NivelController@store')->name('niveles.store');
Route::get('registro/niveles/{id}/edit', 'NivelController@edit')->name('niveles.edit');
Route::patch('registro/niveles/{id}', 'NivelController@update')->name('niveles.update');
Route::get('registro/niveles/{id}', 'NivelController@show')->name('niveles.show');
Route::post('registro/niveles/{id}', 'NivelController@destroy')->name('niveles.destroy');
Route::get('registro/niveles_by_rack/{rack}', 'NivelController@niveles_by_rack')->name('niveles.by_rack');

Route::get('registro/posiciones', 'PosicionController@index')->name('posiciones.index');
Route::get('registro/posiciones/create', 'PosicionController@create')->name('posiciones.create');
Route::post('registro/posiciones/create', 'PosicionController@store')->name('posiciones.store');
Route::get('registro/posiciones/{id}/edit', 'PosicionController@edit')->name('posiciones.edit');
Route::patch('registro/posiciones/{id}', 'PosicionController@update')->name('posiciones.update');
Route::get('registro/posiciones/{id}', 'PosicionController@show')->name('posiciones.show');
Route::post('registro/posiciones/{id}', 'PosicionController@destroy')->name('posiciones.destroy');
Route::get('registro/posiciones_by_nivel/{nivel}', 'PosicionController@posiciones_by_nivel')->name('posiciones.by_nivel');


Route::get('registro/bines', 'BinController@index')->name('bines.index');
Route::get('registro/bines/create', 'BinController@create')->name('bines.create');
Route::post('registro/bines/create', 'BinController@store')->name('bines.store');
Route::get('registro/bines/{id}/edit', 'BinController@edit')->name('bines.edit');
Route::patch('registro/bines/{id}', 'BinController@update')->name('bines.update');
Route::get('registro/bines/{id}', 'BinController@show')->name('bines.show');
Route::post('registro/bines/{id}', 'BinController@destroy')->name('bines.destroy');
Route::get('registro/bines_by_posicion/{id}', 'BinController@bines_by_posicion')->name('bines.by_posicion');

Route::get('registro/ubicaciones', 'UbicacionController@index')->name('ubicaciones.index');
Route::get('registro/ubicaciones/create', 'UbicacionController@create')->name('ubicaciones.create');
Route::post('registro/ubicaciones/create', 'UbicacionController@store')->name('ubicaciones.store');
Route::get('registro/ubicaciones/{id}/edit', 'UbicacionController@edit')->name('ubicaciones.edit');
Route::patch('registro/ubicaciones/{id}', 'UbicacionController@update')->name('ubicaciones.update');
Route::get('registro/ubicaciones/{id}', 'UbicacionController@show')->name('ubicaciones.show');
Route::post('registro/ubicaciones/{id}', 'UbicacionController@destroy')->name('ubicaciones.destroy');
Route::get('registro/ubicaciones/search/{id}', 'UbicacionController@buscar_by_codigo')->name('ubicaciones.search');

Route::get('registro/ubicaciones', 'UbicacionController@index')->name('ubicaciones.index');


Route::get('registro/productos', 'ProductoController@index')->name('productos.index');
Route::get('registro/productos/create', 'ProductoController@create')->name('productos.create');
Route::post('registro/productos/create', 'ProductoController@store')->name('productos.store');
Route::get('registro/productos/{id}/edit', 'ProductoController@edit')->name('productos.edit');
Route::patch('registro/productos/{id}', 'ProductoController@update')->name('productos.update');
Route::get('registro/productos/{id}', 'ProductoController@show')->name('productos.show');
Route::post('registro/productos/importar', 'ProductoController@importar')->name('productos.importar');
Route::post('registro/productos/{id}', 'ProductoController@destroy')->name('productos.destroy');
Route::get('registro/productos/search/{value}', 'ProductoController@search')->name('productos.search');


Route::get('registro/actividades', 'ActividadController@index')->name('actividades.index');
Route::get('registro/actividades/create', 'ActividadController@create')->name('actividades.create');
Route::post('registro/actividades/create', 'ActividadController@store')->name('actividades.store');
Route::get('registro/actividades/{id}/edit', 'ActividadController@edit')->name('actividades.edit');
Route::patch('registro/actividades/{id}', 'ActividadController@update')->name('actividades.update');
Route::get('registro/actividades/{id}', 'ActividadController@show')->name('actividades.show');
Route::post('registro/actividades/{id}', 'ActividadController@destroy')->name('actividades.destroy');


Route::get('registro/tipo_movimientos', 'TipoMovimientoController@index')->name('tipo_movimientos.index');
Route::get('registro/tipo_movimientos/create', 'TipoMovimientoController@create')->name('tipo_movimientos.create');
Route::post('registro/tipo_movimientos/create', 'TipoMovimientoController@store')->name('tipo_movimientos.store');
Route::get('registro/tipo_movimientos/{id}/edit', 'TipoMovimientoController@edit')->name('tipo_movimientos.edit');
Route::patch('registro/tipo_movimientos/{id}', 'TipoMovimientoController@update')->name('tipo_movimientos.update');
Route::get('registro/tipo_movimientos/{id}', 'TipoMovimientoController@show')->name('tipo_movimientos.show');
Route::post('registro/tipo_movimientos/{id}', 'TipoMovimientoController@destroy')->name('tipo_movimientos.destroy');


Route::get('registro/colaboradores', 'ColaboradorController@index')->name('colaboradores.index');
Route::get('registro/colaboradores/search', 'ColaboradorController@search')->name('colaboradores.search');
Route::get('registro/colaboradores/create', 'ColaboradorController@create')->name('colaboradores.create');
Route::post('registro/colaboradores/create', 'ColaboradorController@store')->name('colaboradores.store');
Route::get('registro/colaboradores/{id}/edit', 'ColaboradorController@edit')->name('colaboradores.edit');
Route::patch('registro/colaboradores/{id}', 'ColaboradorController@update')->name('colaboradores.update');
Route::get('registro/colaboradores/{id}', 'ColaboradorController@show')->name('colaboradores.show');
Route::post('registro/colaboradores/importar', 'ColaboradorController@importar')->name('colaboradores.importar');
Route::post('registro/colaboradores/{id}', 'ColaboradorController@destroy')->name('colaboradores.destroy');

Route::get('recepcion/materia_prima', 'RecepcionController@index')->name('recepcion.materia_prima.index');

Route::get('recepcion/materia_prima/create', 'RecepcionController@create')
    ->middleware('permission:role-create')
    ->name('recepcion.materia_prima.create');

Route::post('recepcion/materia_prima/create', 'RecepcionController@store')->name('recepcion.materia_prima.store');
Route::get('recepcion/materia_prima/{id}', 'RecepcionController@show')->name('recepcion.materia_prima.show');
Route::get('recepcion/materia_prima/reporte/{id}', 'ReporteRecepcionController@reporte_recepcion')->name('recepcion.materia_prima.reporte_recepcion');
Route::get('recepcion/materia_prima/{id}/edit', 'RecepcionController@edit')->name('recepcion.materia_prima.edit');
Route::patch('recepcion/materia_prima/{id}', 'RecepcionController@update')->name('recepcion.materia_prima.update');

Route::get('recepcion/transito', 'RecepcionController@transito')->name('recepcion.transito.index');
Route::get('recepcion/transito/{id}/ingreso', 'RecepcionController@ingreso_transito')->name('recepcion.transito.ingreso');
Route::get('recepcion/transito/reporte/{id}', 'ReporteRecepcionController@reporte_calidad')->name('recepcion.transito.reporte_calidad');
Route::patch('recepcion/transito/{id}', 'RecepcionController@ingresar')->name('recepcion.transito.ingresar');
Route::get('recepcion/transito/{id}', 'RecepcionController@show_transito')->name('recepcion.transito.show_transito');

Route::get('recepcion/ubicacion', 'RecepcionController@recepcion_ubicacion')->name('recepcion.ubicacion.index');
Route::get('recepcion/ubicacion/{id}/ubicar', 'RecepcionController@ubicacion')->name('recepcion.ubicacion.ubicar');
Route::patch('recepcion/ubicacion/{id}', 'RecepcionController@ubicar')->name('recepcion.ubicacion.ubicar');
Route::get('recepcion/ubicacion/{id}', 'RecepcionController@show_producto_a_ubicar')->name('recepcion.ubicacion.show');


Route::get('recepcion/kardex', 'MovimientoController@index')->name('movimientos.bodegas.index');
Route::get('recepcion/kardex/reporte', 'MovimientoController@reporte_excel')->name('movimientos.bodegas.excel');
Route::get('movimientos/existencia/productos', 'MovimientoController@existencia')->name('movimientos.existencia.productos');

Route::get('control/chaomin', 'ChaomeanController@index')->name('chaomin.index');
Route::get('control/chaomin/create', 'ChaomeanController@create')->name('chaomin.create');
Route::post('control/chaomin/verficar_no_orden_produccion', 'ChaomeanController@verficar_no_orden_produccion')->name('chaomin.verficar_no_orden_produccion');
Route::post('control/chaomin/iniciar', 'ChaomeanController@iniciar_linea_chaomein')->name('chaomin.iniciar_linea_chaomein');
Route::post('control/chaomin/nuevo_registro', 'ChaomeanController@nuevo_registro')->name('chaomin.nuevo_registro');
Route::post('control/chaomin/create', 'ChaomeanController@store')->name('chaomin.store');
Route::get('control/chaomin/{id}/edit', 'ChaomeanController@edit')->name('chaomin.edit');
Route::get('control/chaomin/reporte/{id}', 'ReporteLineaChaomein@reporte_linea_chaomein')->name('chaomin.reporte');
Route::patch('control/chaomin/{id}', 'ChaomeanController@update')->name('chaomin.update');
Route::get('control/chaomin/{id}', 'ChaomeanController@show')->name('chaomin.show');

Route::get('control/chaomin', 'ChaomeanController@index')->name('chaomin.index');


Route::get('control/verificacion_materias', 'VerificacionMateriasController@index')->name('verificacion_materias.index');
Route::get('control/verificacion_materias/create', 'VerificacionMateriasController@create')->name('insertar_detalle.create');
Route::post('control/verificacion_materias/create', 'VerificacionMateriasController@store')->name('insertar_detalle.store');
Route::post('control/verificacion_materias/iniciar_harina', 'VerificacionMateriasController@iniciar_harina')
    ->name('insertar_detalle.iniciar_harina');
Route::post('control/verificacion_materias/iniciar_formulario', 'VerificacionMateriasController@iniciar_formulario')
    ->name('insertar_detalle.iniciar_formulario');
Route::post('control/verificacion_materias/insertar_detalle', 'VerificacionMateriasController@insertar_detalle')
    ->name('insertar_detalle.insertar_detalle');
Route::post('control/verificacion_materias/actualizar_detalle', 'VerificacionMateriasController@actualizar_detalle')
    ->name('insertar_detalle.actualizar_detalle');
Route::post('control/verificacion_materias/borrar_detalle', 'VerificacionMateriasController@borrar_detalle')
    ->name('verificacion_materias.borrar_detalle');

Route::get('control/verificacion_materias/{id}/edit', 'VerificacionMateriasController@edit')->name('verificacion_materias.edit');
Route::get('control/verificacion_materias/reporte/{id}', 'ReporteLineaChaomein@reporte_verificacion_materias')->name('reporte_verificacion_materias');
Route::patch('control/verificacion_materias/{id}', 'VerificacionMateriasController@update')->name('verificacion_materias.update');
Route::get('control/verificacion_materias/{id}', 'VerificacionMateriasController@show')->name('verificacion_materias.show');
Route::post('control/verificacion_materias/{id}', 'VerificacionMateriasController@destroy')->name('verificacion_materias.destroy');


Route::get('control/mezcla_harina', 'MezclaHarinaController@index')->name('mezcla_harina.index');
Route::get('control/mezcla_harina/create', 'MezclaHarinaController@create')->name('mezcla_harina.create');
Route::post('control/mezcla_harina/create', 'MezclaHarinaController@store')->name('mezcla_harina.store');
Route::post('control/mezcla_harina/iniciar_harina', 'MezclaHarinaController@iniciar_harina')
    ->name('mezcla_harina.iniciar_harina');
Route::post('control/mezcla_harina/iniciar_formulario', 'MezclaHarinaController@iniciar_formulario')
    ->name('mezcla_harina.iniciar_formulario');
Route::post('control/mezcla_harina/insertar_detalle', 'MezclaHarinaController@insertar_detalle')
    ->name('mezcla_harina.insertar_detalle');
Route::post('control/mezcla_harina/actualizar_detalle', 'MezclaHarinaController@actualizar_detalle')
    ->name('mezcla_harina.actualizar_detalle');
Route::post('control/mezcla_harina/borrar_detalle', 'MezclaHarinaController@borrar_detalle')
    ->name('mezcla_harina.borrar_detalle');
Route::get('control/mezcla_harina/{id}/edit', 'MezclaHarinaController@edit')->name('mezcla_harina.edit');
Route::get('control/mezcla_harina/reporte/{id}', 'ReporteLineaChaomein@reporte_mezcla_harina')->name('reporte_mezcla_harina');
Route::patch('control/mezcla_harina/{id}', 'MezclaHarinaController@update')->name('mezcla_harina.update');
Route::get('control/mezcla_harina/{id}', 'MezclaHarinaController@show')->name('mezcla_harina.show');
Route::post('control/mezcla_harina/{id}', 'MezclaHarinaController@destroy')->name('mezcla_harina.destroy');

Route::get('control/laminado', 'LaminadoController@index')->name('control.laminado.index');
Route::get('control/laminado/create', 'LaminadoController@create')->name('laminado.create');
Route::post('control/laminado/iniciar_laminado', 'LaminadoController@iniciar_laminado')->name('laminado.iniciar_laminado');
Route::post('control/laminado/iniciar_formulario', 'LaminadoController@iniciar_formulario')->name('laminado.iniciar_formulario');
Route::post('control/laminado/insertar_detalle', 'LaminadoController@insertar_detalle')->name('laminado.insertar_detalle');
Route::post('control/laminado/nuevo_registro', 'LaminadoController@nuevo_registro')->name('laminado.nuevo_registro');
Route::post('control/laminado/borrar_detalle', 'LaminadoController@borrar_detalle')->name('laminado.borrar_detalle');
Route::post('control/laminado/create', 'LaminadoController@store')->name('laminado.store');
Route::get('control/laminado/{id}/edit', 'LaminadoController@edit')->name('laminado.edit');
Route::patch('control/laminado/{id}', 'LaminadoController@update')->name('laminado.update');
Route::get('control/laminado/{id}', 'LaminadoController@show')->name('laminado.show');
Route::get('control/laminado/reporte/{id}', 'ReporteLineaChaomein@reporte_laminado')->name('laminado.show');
Route::post('control/laminado/{id}', 'LaminadoController@destroy')->name('laminado.destroy');

Route::get('control/peso_humedo', 'PesoHumedoController@index')->name('peso_humedo.index');
Route::get('control/peso_humedo/create', 'PesoHumedoController@create')->name('peso_humedo.create');
Route::post('control/peso_humedo/create', 'PesoHumedoController@store')->name('peso_humedo.store');
Route::post('control/peso_humedo/iniciar_laminado', 'PesoHumedoController@iniciar_laminado')->name('peso_humedo.iniciar_laminado');
Route::post('control/peso_humedo/iniciar_formulario', 'PesoHumedoController@iniciar_formulario')->name('peso_humedo.iniciar_formulario');
Route::post('control/peso_humedo/insertar_detalle', 'PesoHumedoController@insertar_detalle')->name('peso_humedo.insertar_detalle');
Route::post('control/peso_humedo/nuevo_registro', 'PesoHumedoController@nuevo_registro')->name('peso_humedo.nuevo_registro');
Route::post('control/peso_humedo/borrar_detalle', 'PesoHumedoController@borrar_detalle')->name('peso_humedo.borrar_detalle');
Route::get('control/peso_humedo/{id}/edit', 'PesoHumedoController@edit')->name('peso_humedo.edit');
Route::patch('control/peso_humedo/{id}', 'PesoHumedoController@update')->name('peso_humedo.update');
Route::get('control/peso_humedo/{id}', 'PesoHumedoController@show')->name('peso_humedo.show');
Route::get('control/peso_humedo/reporte/{id}', 'ReporteLineaChaomein@reporte_peso_humedo')->name('peso_humedo.reporte');
Route::post('control/peso_humedo/{id}', 'PesoHumedoController@destroy')->name('peso_humedo.destroy');

Route::get('control/peso_seco', 'PesoSecoController@index')->name('peso_seco.index');
Route::get('control/peso_seco/create', 'PesoSecoController@create')->name('peso_seco.create');
Route::post('control/peso_seco/create', 'PesoSecoController@store')->name('peso_seco.store');
Route::post('control/peso_seco/iniciar_laminado', 'PesoSecoController@iniciar_laminado')->name('peso_seco.iniciar_laminado');
Route::post('control/peso_seco/insertar_detalle', 'PesoSecoController@insertar_detalle')->name('peso_seco.insertar_detalle');
Route::post('control/peso_seco/iniciar_formulario', 'PesoSecoController@iniciar_formulario')->name('peso_seco.iniciar_formulario');
Route::post('control/peso_seco/nuevo_registro', 'PesoSecoController@nuevo_registro')->name('peso_seco.nuevo_registro');
Route::post('control/peso_seco/borrar_detalle', 'PesoSecoController@borrar_detalle')->name('peso_seco.borrar_detalle');
Route::get('control/peso_seco/{id}/edit', 'PesoSecoController@edit')->name('peso_seco.edit');
Route::patch('control/peso_seco/{id}', 'PesoSecoController@update')->name('peso_seco.update');
Route::get('control/peso_seco/{id}', 'PesoSecoController@show')->name('peso_seco.show');
Route::get('control/peso_seco/reporte/{id}', 'ReporteLineaChaomein@reporte_peso_seco')->name('peso_seco.reporte_peso_seco');
Route::post('control/peso_seco/{id}', 'PesoSecoController@destroy')->name('peso_seco.destroy');

Route::get('control/precocido', 'PrecocidoController@index')->name('precocido.index');
Route::get('control/precocido/create', 'PrecocidoController@create')->name('precocido.create');
Route::post('control/precocido/create', 'PrecocidoController@store')->name('precocido.store');
Route::post('control/precocido/iniciar_laminado', 'PrecocidoController@iniciar_laminado')->name('precocido.iniciar_laminado');
Route::post('control/precocido/insertar_detalle', 'PrecocidoController@insertar_detalle')->name('precocido.insertar_detalle');
Route::post('control/precocido/actualizar_detalle', 'PrecocidoController@actualizar_detalle')->name('precocido.actualizar_detalle');
Route::post('control/precocido/iniciar_formulario', 'PrecocidoController@iniciar_formulario')->name('precocido.iniciar_formulario');
Route::post('control/precocido/nuevo_registro', 'PrecocidoController@nuevo_registro')->name('precocido.nuevo_registro');
Route::post('control/precocido/borrar_detalle', 'PrecocidoController@borrar_detalle')->name('precocido.borrar_detalle');
Route::get('control/precocido/{id}/edit', 'PrecocidoController@edit')->name('precocido.edit');
Route::patch('control/precocido/{id}', 'PrecocidoController@update')->name('precocido.update');
Route::get('control/precocido/{id}', 'PrecocidoController@show')->name('precocido.show');
Route::get('control/precocido/reporte/{id}', 'ReporteLineaChaomein@reporte_precocido')->name('precocido.reporte_precocido');
Route::post('control/precocido/{id}', 'PrecocidoController@destroy')->name('precocido.destroy');


Route::get('produccion/trazabilidad_chao_mein', 'OperacionController@index')->name('produccion.operacion.index');
Route::get('produccion/trazabilidad_chao_mein/create', 'OperacionController@create')->name('produccion.operacion.create');
Route::get('produccion/trazabilidad_chao_mein/verificar_proximo_lote', 'OperacionController@verificar_proximo_lote')->name('produccion.operacion.verificar_proximo_lote');
Route::get('produccion/trazabilidad_chao_mein/verificar_existencia_lote', 'OperacionController@verificar_existencia_lote')->name('produccion.operacion.verificar_existencia_lote');
Route::post('produccion/trazabilidad_chao_mein/create', 'OperacionController@store')->name('produccion.operacion.store');
Route::post('produccion/trazabilidad_chao_mein/finalizar_asistencia', 'OperacionController@finalizar_asistencia')->name('produccion.operacion.finalizar_asistencia');
Route::get('produccion/trazabilidad_chao_mein/buscar_producto', 'OperacionController@buscar_producto')->name('produccion.operacion.buscar_producto');
Route::get('produccion/trazabilidad_chao_mein/buscar_orden_produccion', 'OperacionController@buscar_orden_produccion')->name('produccion.operacion.buscar_orden_produccion');
Route::get('produccion/trazabilidad_chao_mein/{id}', 'OperacionController@show')->name('produccion.operacion.show');
Route::get('produccion/trazabilidad_chao_mein/{id}/edit', 'OperacionController@edit')->name('produccion.operacion.edit');
Route::get('produccion/trazabilidad_chao_mein/reporte/{id}', 'ReporteControlTrazabilidadController@reporte_control_trazabilidad')->name('produccion.operacion.reporte');


Route::get('produccion/requisiciones', 'RequisicionController@index')->name('produccion.requisiciones.index');
Route::get('produccion/requisiciones/create', 'RequisicionController@create')->name('produccion.requisiciones.create');
Route::post('produccion/requisiciones/create', 'RequisicionController@store')->name('produccion.requisiciones.store');
Route::post('produccion/requisiciones/importar', 'RequisicionController@importar')->name('produccion.requisiciones.importar');
Route::get('produccion/requisiciones/validar_requisicion/{no_requisicion}', 'RequisicionController@verificarOrdenRequisicion')
    ->name('produccion.requisiciones.validar_requisicion');
Route::get('produccion/requisiciones/validar_orden_produccion/{no_orden}/{id}', 'RequisicionController@verificarOrdenProduccion')
    ->name('produccion.requisiciones.validar_orden_produccion');
Route::post('produccion/requisiciones/reservar', 'RequisicionController@reservar')->name('produccion.requisiciones.reservar');
Route::post('produccion/requisiciones/borrar_de_reserva', 'RequisicionController@borrar_de_reserva')->name('produccion.requisiciones.borrar_de_reserva');
Route::get('produccion/requisiciones/en_reserva/{id_producto}', 'RequisicionController@en_reserva')->name('produccion.requisiciones.en_reserva');
Route::get('produccion/requisiciones/borrar_reservas', 'RequisicionController@borrar_reservas')->name('produccion.requisiciones.borras_reservas');
Route::get('produccion/requisiciones/{id}', 'RequisicionController@show')->name('produccion.requisiciones.show');
Route::get('produccion/requisiciones/reporte/{id}', 'ReporteProduccionController@reporte_requisicion')->name('produccion.requisiciones.show');
Route::post('produccion/requisiciones/{id}', 'RequisicionController@destroy')->name('produccion.requisiciones.destroy');

Route::get('produccion/picking/', 'PickingController@index')->name('produccion.picking.index');
Route::get('produccion/picking/{id}/despachar', 'PickingController@despachar')->name('produccion.picking.despachar');
Route::get('produccion/picking/{id}', 'PickingController@show')->name('produccion.picking.show');
Route::post('produccion/picking/leer/{id_reserva}', 'PickingController@leer')->name('produccion.picking.leer');
Route::post('produccion/picking/create', 'PickingController@store')->name('produccion.picking.store');

Route::get('produccion/mezcladora', 'MezcladoraController@index')->name('mezcladora.index');
Route::get('produccion/mezcladora/create', 'MezcladoraController@create')->name('mezcladora.create');
Route::post('produccion/mezcladora/create', 'MezcladoraController@store')->name('mezcladora.store');
Route::get('produccion/mezcladora/{id}/edit', 'MezcladoraController@edit')->name('mezcladora.edit');
Route::patch('produccion/mezcladora/{id}', 'MezcladoraController@update')->name('mezcladora.update');
Route::get('produccion/mezcladora/{id}', 'MezcladoraController@show')->name('mezcladora.show');
Route::post('produccion/mezcladora/{id}', 'MezcladoraController@destroy')->name('mezcladora.destroy');


Route::get('sopas/fritura', 'FrituraSopasController@index')->name('fritura.index');
Route::get('sopas/fritura/create', 'FrituraSopasController@create')->name('fritura.create');
Route::post('sopas/fritura/create', 'FrituraSopasController@store')->name('fritura.store');
Route::post('sopas/fritura/iniciar_fritura', 'FrituraSopasController@iniciar_fritura')->name('fritura.iniciar_fritura');
Route::post('sopas/fritura/iniciar_formulario', 'FrituraSopasController@iniciar_formulario')->name('fritura.iniciar_formulario');
Route::post('sopas/fritura/insertar_detalle', 'FrituraSopasController@insertar_detalle')->name('fritura.insertar_detalle');
Route::post('sopas/fritura/nuevo_registro', 'FrituraSopasController@nuevo_registro')->name('fritura.nuevo_registro');
Route::post('sopas/fritura/borrar_detalle', 'FrituraSopasController@borrar_detalle')->name('fritura.borrar_detalle');
Route::get('sopas/fritura/{id}/edit', 'FrituraSopasController@edit')->name('fritura.edit');
Route::patch('sopas/fritura/{id}', 'FrituraSopasController@update')->name('fritura.update');
Route::get('sopas/fritura/{id}', 'FrituraSopasController@show')->name('fritura.show');
Route::get('sopas/fritura/reporte/{id}', 'ReporteLineaSopas@reporte_fritura')->name('fritura.reporte_fritura');
Route::post('sopas/fritura/{id}', 'FrituraSopasController@destroy')->name('fritura.destroy');

Route::get('sopas/mezclado_sopas', 'MezcladoSopasController@index')->name('mezclado_sopas.index');
Route::get('sopas/mezclado_sopas/create', 'MezcladoSopasController@create')->name('mezclado_sopas.create');
Route::post('sopas/mezclado_sopas/create', 'MezcladoSopasController@store')->name('mezclado_sopas.store');
Route::post('sopas/mezclado_sopas/iniciar_mezclado_sopas', 'MezcladoSopasController@iniciar_mezclado_sopas')->name('mezclado_sopas.iniciar_laminado');
Route::post('sopas/mezclado_sopas/iniciar_formulario', 'MezcladoSopasController@iniciar_formulario')->name('mezclado_sopas.iniciar_formulario');
Route::post('sopas/mezclado_sopas/insertar_detalle', 'MezcladoSopasController@insertar_detalle')->name('mezclado_sopas.insertar_detalle');
Route::post('sopas/mezclado_sopas/actualizar_detalle', 'MezcladoSopasController@actualizar_detalle')->name('mezclado_sopas.actualizar_detalle');
Route::post('sopas/mezclado_sopas/nuevo_registro', 'MezcladoSopasController@nuevo_registro')->name('mezclado_sopas.nuevo_registro');
Route::post('sopas/mezclado_sopas/borrar_detalle', 'MezcladoSopasController@borrar_detalle')->name('mezclado_sopas.borrar_detalle');
Route::get('sopas/mezclado_sopas/{id}/edit', 'MezcladoSopasController@edit')->name('mezclado_sopas.edit');
Route::patch('sopas/mezclado_sopas/{id}', 'MezcladoSopasController@update')->name('mezclado_sopas.update');
Route::get('sopas/mezclado_sopas/{id}', 'MezcladoSopasController@show')->name('mezclado_sopas.show');
Route::get('sopas/mezclado_sopas/reporte/{id}', 'ReporteLineaSopas@reporte_mezclado_sopas')->name('mezclado_sopas.show');
Route::post('sopas/mezclado_sopas/{id}', 'MezcladoSopasController@destroy')->name('mezclado_sopas.destroy');


Route::get('sopas/peso_pasta', 'PesoPastaController@index')->name('peso_pasta.index');
Route::get('sopas/peso_pasta/create', 'PesoPastaController@create')->name('peso_pasta.create');
Route::post('sopas/peso_pasta/create', 'PesoPastaController@store')->name('peso_pasta.store');
Route::post('sopas/peso_pasta/inciar_peso', 'PesoPastaController@iniciar_peso')->name('peso_pasta.iniciar_laminado');
Route::post('sopas/peso_pasta/iniciar_formulario', 'PesoPastaController@iniciar_formulario')->name('peso_pasta.iniciar_formulario');
Route::post('sopas/peso_pasta/insertar_detalle', 'PesoPastaController@insertar_detalle')->name('peso_pasta.insertar_detalle');
Route::post('sopas/peso_pasta/nuevo_registro', 'PesoPastaController@nuevo_registro')->name('peso_pasta.nuevo_registro');
Route::post('sopas/peso_pasta/borrar_detalle', 'PesoPastaController@borrar_detalle')->name('peso_pasta.borrar_detalle');
Route::get('sopas/peso_pasta/{id}/edit', 'PesoPastaController@edit')->name('peso_pasta.edit');
Route::patch('sopas/peso_pasta/{id}', 'PesoPastaController@update')->name('peso_pasta.update');
Route::get('sopas/peso_pasta/{id}', 'PesoPastaController@show')->name('peso_pasta.show');
Route::get('sopas/peso_pasta/reporte/{id}', 'ReporteLineaSopas@reporte_peso_pasta')->name('peso_pasta.reporte_peso_pasta');
Route::post('sopas/peso_pasta/{id}', 'PesoPastaController@destroy')->name('peso_pasta.destroy');

Route::get('sopas/laminado', 'LaminadoSopasController@index')->name('sopas.laminado..index');
Route::get('sopas/laminado/create', 'LaminadoSopasController@create')->name('sopas.laminado..create');
Route::post('sopas/laminado/create', 'LaminadoSopasController@store')->name('sopas.laminado..store');
Route::post('sopas/laminado/iniciar_laminado', 'LaminadoSopasController@iniciar_laminado')->name('sopas.laminado..iniciar_laminado');
Route::post('sopas/laminado/iniciar_formulario', 'LaminadoSopasController@iniciar_formulario')->name('sopas.laminado..iniciar_formulario');
Route::post('sopas/laminado/insertar_detalle', 'LaminadoSopasController@insertar_detalle')->name('sopas.laminado..insertar_detalle');
Route::post('sopas/laminado/nuevo_registro', 'LaminadoSopasController@nuevo_registro')->name('sopas.laminado..nuevo_registro');
Route::post('sopas/laminado/borrar_detalle', 'LaminadoSopasController@borrar_detalle')->name('sopas.laminado..borrar_detalle');
Route::get('sopas/laminado/{id}/edit', 'LaminadoSopasController@edit')->name('sopas.laminado..edit');
Route::patch('sopas/laminado/{id}', 'LaminadoSopasController@update')->name('sopas.laminado..update');
Route::get('sopas/laminado/{id}', 'LaminadoSopasController@show')->name('sopas.laminado..show');
Route::get('sopas/laminado/reporte/{id}', 'ReporteLineaSopas@reporte_laminado')->name('sopas.laminado..reporte_laminado');
Route::post('sopas/laminado/{id}', 'LaminadoSopasController@destroy')->name('sopas.laminado.destroy');


Route::get('sopas/liberacion', 'LineaSopaController@index')->name('sopas.liberacion');
Route::get('sopas/liberacion/create', 'LineaSopaController@create')->name('sopas.create');
Route::post('sopas/liberacion/create', 'LineaSopaController@store')->name('sopas.store');
Route::post('sopas/liberacion/verficar_no_orden_produccion', 'LineaSopaController@verficar_no_orden_produccion')->name('chaomin.verficar_no_orden_produccion');
Route::post('sopas/liberacion/iniciar', 'LineaSopaController@iniciar_linea_sopas')->name('sopas.iniciar_linea_sopas');
Route::post('sopas/liberacion/nuevo_registro', 'LineaSopaController@nuevo_registro')->name('sopas.nuevo_registro');
Route::get('sopas/liberacion/{id}/edit', 'LineaSopaController@edit')->name('sopas.liberacion.edit');
Route::get('sopas/liberacion/{id}', 'LineaSopaController@show')->name('sopas.liberacion.show');
Route::get('sopas/liberacion/reporte/{id}', 'ReporteLineaSopas@linea_sopas')->name('sopas.liberacion.linea_sopas');


Route::get('consultas/trazabilidad', 'ConsultaTrazabilidadController@index')->name('consulta.trazabilidad');

