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


Route::get('/', [App\Http\Controllers\HomeController::class, 'welcome']);
Auth::routes();

Route::get('/search', [App\Http\Controllers\SearchController::class, 'show']);
Route::get('/platos/json', [App\Http\Controllers\SearchController::class, 'data']);

Route::get('/home', [App\Http\Controllers\DashboardController::class, 'index'])->name('home');
Route::get('/mispedidos', [App\Http\Controllers\DashboardController::class, 'estadoPedido'])->name('mispedidos');
Route::get('/platos/{id}', [App\Http\Controllers\ProductoController::class, 'show']);        //ver info producto
Route::get('/categorias/{id}', [App\Http\Controllers\CategoriaController::class, 'show']);

Route::post('/cart', [App\Http\Controllers\CartDetailController::class, 'store']);
Route::delete('/cart', [App\Http\Controllers\CartDetailController::class, 'destroy']);

Route::post('/order', [App\Http\Controllers\CartController::class, 'update']);

Route::middleware(['auth', 'admin'])->group(function () {           //->prefix('admin')-> y borro todos los admin
    Route::get('/admin/platos', [App\Http\Controllers\Admin\ProductoController::class, 'index']);        //listado
    Route::get('/admin/platos/create', [App\Http\Controllers\Admin\ProductoController::class, 'create']); //crear nuevos platos
    Route::post('/admin/platos', [App\Http\Controllers\Admin\ProductoController::class, 'store']);       //registrar los datos

    Route::get('/admin/platos/{id}/edit', [App\Http\Controllers\Admin\ProductoController::class, 'edit']); //formulario de edicion
    Route::post('/admin/platos/{id}/edit', [App\Http\Controllers\Admin\ProductoController::class, 'update']);       //actualizar edición
    Route::delete('/admin/platos/{id}', [App\Http\Controllers\Admin\ProductoController::class, 'destroy']); //formulario de edicion

    Route::get('/admin/platos/{id}/imagenes', [App\Http\Controllers\Admin\ImagenController::class, 'index']); //Listado de imagenes
    Route::post('/admin/platos/{id}/imagenes', [App\Http\Controllers\Admin\ImagenController::class, 'store']);//registro de imagenes
    Route::delete('/admin/platos/{id}/imagenes', [App\Http\Controllers\Admin\ImagenController::class, 'destroy']);
    Route::get('/admin/platos/{id}/imagenes/select/{imagen}', [App\Http\Controllers\Admin\ImagenController::class, 'select']); //Destacar imagenes


    Route::get('/admin/categorias', [App\Http\Controllers\Admin\CategoriaController::class, 'index']);        //listado
    Route::get('/admin/categorias/create', [App\Http\Controllers\Admin\CategoriaController::class, 'create']); //formulario
    Route::post('/admin/categorias', [App\Http\Controllers\Admin\CategoriaController::class, 'store']);       //registrar
    Route::get('/admin/categorias/{id}/edit', [App\Http\Controllers\Admin\CategoriaController::class, 'edit']); //formulario de edicion
    Route::post('/admin/categorias/{id}/edit', [App\Http\Controllers\Admin\CategoriaController::class, 'update']);       //actualizar
    Route::delete('/admin/categorias/{id}', [App\Http\Controllers\Admin\CategoriaController::class, 'destroy']); //form eliminar

    Route::get('/admin/gestion/{menu}', [App\Http\Controllers\Admin\PedidoController::class, 'index']); //listar
    //Route::get('/admin/gestion/pdf', [App\Http\Controllers\Admin\PedidoController::class, 'pdf']); //pdf generator
    //Route::get('/admin/pedidos/{menu}/{id}/edit', [App\Http\Controllers\Admin\PedidoController::class, 'edit']); //formulario de edicion
    Route::post('/admin/gestion/{menu}', [App\Http\Controllers\Admin\PedidoController::class, 'update']);       //actualizar
    Route::delete('/admin/pedidos/{id}', [App\Http\Controllers\Admin\PedidoController::class, 'destroy']); //form eliminar
    Route::delete('/admin/gestion/newCaja', [App\Http\Controllers\Admin\PedidoController::class, 'destroyCarts']); //eliminar carts al renovar caja

    Route::get('/admin/quick-order', [App\Http\Controllers\Admin\QuickOrderController::class, 'index']);        //listado
    Route::post('/admin/quick-order', [App\Http\Controllers\Admin\QuickOrderController::class, 'update']); //generando el cart
    Route::delete('/admin/quick-order', [App\Http\Controllers\CartDetailController::class, 'destroy']); //uso el mismo destroy que un user normal
});


//cr
