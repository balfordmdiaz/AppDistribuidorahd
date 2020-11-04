<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;

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


//rutas para el controlador employees
//Route::get('employees',[EmployeesController::class, 'index'])->name('employees.index');

Route::resource('employees','App\Http\Controllers\EmployeesController');
Route::post('employees', [EmployeesController::class, 'store'])->name('employees.store');
Route::get('employees/destroy/{idempleado}', [EmployeesController::class, 'destroy'])->name('employees.destroy');
Route::get('employees/edit/{idempleado}', [EmployeesController::class, 'edit'])->name('employees.edit');
Route::post('employees/update', [EmployeesController::class, 'update'])->name('employees.update');


Route::resource('clients','App\Http\Controllers\ClientsController');
Route::post('clients', [ClientsController::class, 'store'])->name('clients.store');
Route::get('clients/destroy/{idcliente}', [ClientsController::class, 'destroy'])->name('clients.destroy');
Route::get('clients/edit/{idcliente}', [ClientsController::class, 'edit'])->name('clients.edit');
Route::post('clients/update', [ClientsController::class, 'update'])->name('clients.update');


Route::resource('categories','App\Http\Controllers\CategoriesController');
Route::post('categories', [CategoriesController::class, 'store'])->name('categories.store');
Route::get('categories/destroy/{idcategoria}', [CategoriesController::class, 'destroy'])->name('categories.destroy');
Route::get('categories/edit/{idcategoria}', [CategoriesController::class, 'edit'])->name('categories.edit');
Route::post('categories/update', [CategoriesController::class, 'update'])->name('categories.update');


//Stock


Route::resource('products','App\Http\Controllers\ProductsController');
Route::post('products', [ProductsController::class, 'store'])->name('products.store');
Route::get('products/destroy/{idarticulo}', [ProductsController::class, 'destroy'])->name('products.destroy');
Route::get('products/edit/{idarticulo}', [ProductsController::class, 'edit'])->name('products.edit');
Route::post('products/update', [ProductsController::class, 'update'])->name('products.update');

