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
    return view('home');
});

Auth::routes();
Route::post('/alta', 'UsuarioController@alta')->name('alta');
Route::post('/sugerir', 'UsuarioController@sugerir')->name('sugerir');

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('usuario')->group( function () {
		Route::get('/favoritos', 'UsuarioController@favoritos')->name('usuario.favoritos');
		Route::get('/direcciones', 'UsuarioController@direcciones')->name('usuario.direcciones');
		Route::get('/datos', 'UsuarioController@datos')->name('usuario.datos');
		Route::get('/pedidos', 'UsuarioController@pedidos')->name('usuario.pedidos');
	});

Route::prefix('panel')->group( function () {
		Route::get('/productos', 'NegocioController@productos')->name('negocio.productos');
		Route::get('/ventas', 'NegocioController@ventas')->name('negocio.ventas');
		Route::get('/datos', 'NegocioController@datos')->name('negocio.datos');
		Route::get('/crear/producto', 'NegocioController@crearProducto')->name('negocio.crear.producto');
		Route::get('/modificar/producto/{id}', 'NegocioController@modificarProducto')->name('negocio.modificar.producto');
		Route::post('/actualizar/producto/{id}', 'NegocioController@actualizarProducto')->name('negocio.actualizar.producto');
		Route::post('/guardar/producto', 'NegocioController@guardarProducto')->name('negocio.guardar.producto');
	});

Route::prefix('admin')->group( function () {
		Route::get('/configuraciones', 'AdminController@configuraciones')->name('admin.configuraciones');
		Route::get('/usuarios', 'AdminController@usuarios')->name('admin.usuarios');
	});
