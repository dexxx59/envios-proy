<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\EnvioController;
use App\Http\Controllers\admin\PrendaController as AdminPrendaController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartDetailController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PrendaController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Auth;
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

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/', [TestController::class, 'welcome']);


Route::get('/search', [SearchController::class, 'show']);
Route::get('products/json',[SearchController::class, 'data']);

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('products/{id}', [PrendaController::class, 'show']);
Route::get('categories/{category}', [CategoriaController::class, 'show']);

Route::post('/cart', [CartDetailController::class, 'store']);
Route::delete('/cart', [CartDetailController::class, 'destroy']);

Route::post('/order', [CartController::class, 'update']);

Route::middleware(['auth','admin'])->namespace('Admin')->prefix('admin')->group(function () {
	Route::get('/products', [AdminPrendaController::class, 'index']); //listar 
	Route::get('/products/create', [AdminPrendaController::class, 'create']); //formulario para crear
	Route::post('/products', [AdminPrendaController::class, 'store']); //crear
	Route::get('/products/{id}/edit', [AdminPrendaController::class, 'edit']); //form editar
	Route::post('/products/{id}/edit', [AdminPrendaController::class, 'update']); //actualizar
	Route::post('/products/{id}/delete', [AdminPrendaController::class, 'destroy']); //eliminar

	Route::get('/products/{id}/images', 'ImageController@index'); //listado imagenes 
	Route::post('/products/{id}/images', 'ImageController@store'); //registrar
	Route::delete('/products/{id}/images', 'ImageController@destroy'); //eliminar image
	Route::get('/products/{id}/images/select/{image}', 'ImageController@select'); //destacar 

	//category
	Route::get('/categories', [CategoryController::class, 'index']); //listar 
	Route::get('/categories/create', [CategoryController::class, 'create']); //formulario para crear
	Route::post('/categories', [CategoryController::class, 'store']); //crear
	Route::get('/categories/{category}/edit', [CategoryController::class, 'edit']); //form editar
	
	Route::post('/categories/{category}/edit', [CategoryController::class, 'update']); //actualizar
	Route::delete('/categories/{category}', [CategoryController::class, 'destroy']); //eliminar
	
////envios
	Route::get('/envio', [EnvioController::class, 'index']); //listar 
	Route::get('/envio/create', [EnvioController::class, 'create']); //formulario para crear
	Route::post('/envio', [EnvioController::class, 'store']); //crear
	Route::get('/envio/{envios}/edit', [EnvioController::class, 'edit']); //form editar
	
	Route::post('/envio/{envios}/edit', [EnvioController::class, 'update']); //actualizar
	Route::delete('/envio/{envios}', [EnvioController::class, 'destroy']); //eliminar
});