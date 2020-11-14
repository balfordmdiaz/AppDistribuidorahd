<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\ProvidersController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductStockController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\BillsController;
use App\Http\Controllers\OrdersController;

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
//INICIO
Route::get('/', function () {
    return view('welcome');
});


//rutas para el controlador employees
//Route::get('employees',[EmployeesController::class, 'index'])->name('employees.index');

//EMPLEADOS
Route::resource('employees','App\Http\Controllers\EmployeesController');
Route::post('employees', [EmployeesController::class, 'store'])->name('employees.store');
Route::get('employees/destroy/{idempleado}', [EmployeesController::class, 'destroy'])->name('employees.destroy');
Route::get('employees/edit/{idempleado}', [EmployeesController::class, 'edit'])->name('employees.edit');
Route::post('employees/update', [EmployeesController::class, 'update'])->name('employees.update');

//CLIENTES
Route::resource('clients','App\Http\Controllers\ClientsController');
Route::post('clients', [ClientsController::class, 'store'])->name('clients.store');
Route::get('clients/destroy/{idcliente}', [ClientsController::class, 'destroy'])->name('clients.destroy');
Route::get('clients/edit/{idcliente}', [ClientsController::class, 'edit'])->name('clients.edit');
Route::post('clients/update', [ClientsController::class, 'update'])->name('clients.update');

//PROVEEDORES
Route::resource('providers','App\Http\Controllers\ProvidersController');
Route::post('providers', [ProvidersController::class, 'store'])->name('providers.store');
Route::get('providers/destroy/{idproveedor}', [ProvidersController::class, 'destroy'])->name('providers.destroy');
Route::get('providers/edit/{idproveedor}', [ProvidersController::class, 'edit'])->name('providers.edit');
Route::post('providers/update', [ProvidersController::class, 'update'])->name('providers.update');

//CATEGORIAS
Route::resource('categories','App\Http\Controllers\CategoriesController');
Route::post('categories', [CategoriesController::class, 'store'])->name('categories.store');
Route::get('categories/destroy/{idcategoria}', [CategoriesController::class, 'destroy'])->name('categories.destroy');
Route::get('categories/edit/{idcategoria}', [CategoriesController::class, 'edit'])->name('categories.edit');
Route::post('categories/update', [CategoriesController::class, 'update'])->name('categories.update');

//Stock
Route::resource('productstock','App\Http\Controllers\ProductStockController');
Route::post('productstock', [ProductStockController::class, 'store'])->name('productstock.store');
Route::get('productstock/destroy/{idarticulostock}', [ProductStockController::class, 'destroy'])->name('productstock.destroy');
Route::get('productstock/edit/{idarticulostock}', [ProductStockController::class, 'edit'])->name('productstock.edit');
Route::post('productstock/update', [ProductStockController::class, 'update'])->name('productstock.update');

//PRODUCTOS
Route::resource('products','App\Http\Controllers\ProductsController');
Route::post('products', [ProductsController::class, 'store'])->name('products.store');
Route::get('products/destroy/{idarticulo}', [ProductsController::class, 'destroy'])->name('products.destroy');
Route::get('products/edit/{idarticulo}', [ProductsController::class, 'edit'])->name('products.edit');
Route::post('products/update', [ProductsController::class, 'update'])->name('products.update');

Route::resource('bills','App\Http\Controllers\BillsController');
Route::get('bills/destroy/{idfactura}', [BillsController::class, 'destroy'])->name('bills.destroy');
Route::get('bills/edit/{idfactura}', [BillsController::class, 'edit'])->name('bills.edit');

Route::resource('orders','App\Http\Controllers\OrdersController');
Route::post('orders', [OrdersController::class, 'store'])->name('orders.store');

