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
Route::post('/alta', 'UsuarioController@alta')->name('alta');
Route::post('/sugerir', 'UsuarioController@sugerir')->name('sugerir');
Route::get('/nosotros', 'HomeController@nosotros')->name('nosotros');
Route::get('/nosotros/{pagina}', 'HomeController@nosotros')->name('nosotros.pagina');
Route::get('/tienda/{tienda}', 'HomeController@tienda')->name('tienda');
Route::get('/agregarcarro/{id}', 'UsuarioController@agregarCarrito')->name('agregar.carrito');
Route::get('/marcar/favorito/{id}', 'UsuarioController@marcarFavorito')->name('marcar.favorito');
Route::get('/negocios/{ciudad}/{region}', 'HomeController@buscarNegocios')->name('negocios.ciudad');
Route::post('/buscar', 'HomeController@busquedaNegocios')->name('buscar.negocios.ciudad');
Route::get('/tienda/{slug}/ordenar', 'UsuarioController@ordenar')->name('ordenar')->middleware('auth');
Route::post('/tienda/{slug}/pago', 'UsuarioController@pago')->name('pago')->middleware('auth');

Route::get('/', 'HomeController@index')->name('home');

Route::prefix('usuario')->middleware('auth')->group( function () {
		Route::get('/favoritos', 'UsuarioController@favoritos')->name('usuario.favoritos');
		Route::get('/direcciones', 'UsuarioController@direcciones')->name('usuario.direcciones');
		Route::post('/agregar/direccion', 'UsuarioController@agregarDireccion')->name('usuario.agregar.direccion');
		Route::get('/datos', 'UsuarioController@datos')->name('usuario.datos');
		Route::get('/pedidos', 'UsuarioController@pedidos')->name('usuario.pedidos');
		Route::post('/datos/actualizar', 'UsuarioController@actualizarDatos')->name('usuario.actualizar.datos');
		Route::post('/comentar', 'UsuarioController@comentar')->name('usuario.comentar');
	});

Route::prefix('panel')->middleware('auth')->group( function () {
		Route::get('/productos', 'NegocioController@productos')->name('negocio.productos');
		Route::get('/ventas', 'NegocioController@ventas')->name('negocio.ventas');
		Route::get('/datos', 'NegocioController@datos')->name('negocio.datos');
		Route::get('/horario', 'NegocioController@horario')->name('negocio.horario');
		Route::post('/horario', 'NegocioController@actualizarHorario')->name('negocio.actualizar.horario');
		Route::post('/datos/actualizar', 'NegocioController@actualizarDatos')->name('negocio.actualizar.datos');
		Route::get('/crear/producto', 'NegocioController@crearProducto')->name('negocio.crear.producto');
		Route::get('/modificar/producto/{id}', 'NegocioController@modificarProducto')->name('negocio.modificar.producto');
		Route::post('/actualizar/producto/{id}', 'NegocioController@actualizarProducto')->name('negocio.actualizar.producto');
		Route::post('/guardar/producto', 'NegocioController@guardarProducto')->name('negocio.guardar.producto');
		Route::get('/estatus/producto/{id}/{estatus}', 'NegocioController@estatusProducto')->name('negocio.estatus.producto');
		Route::get('/estatus/orden/{id}/{estatus}', 'NegocioController@estatusOrden')->name('negocio.estatus.orden');
	});

Route::prefix('admin')->middleware('auth')->group( function () {
		Route::get('/configuraciones', 'AdminController@configuraciones')->name('admin.configuraciones');
		Route::get('/seccion/{pag}', 'AdminController@seccion')->name('admin.editar.seccion');
		Route::post('/seccion/{id}', 'AdminController@actualizarSeccion')->name('admin.actualizar.seccion');
		Route::get('/usuarios', 'AdminController@usuarios')->name('admin.usuarios');
		Route::post('/destacar/{id}', 'AdminController@destacar')->name('admin.destacar');
	});
