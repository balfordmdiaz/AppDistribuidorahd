<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\ProvidersController;
use App\Http\Controllers\CategoriesController;
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

Auth::routes();

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//rutas para el controlador employees
//Route::get('employees',[EmployeesController::class, 'index'])->name('employees.index');

//EMPLEADOS
Route::resource('home/employees','App\Http\Controllers\EmployeesController');
Route::post('home/employees', [EmployeesController::class, 'store'])->name('employees.store');
Route::get('home/employees/destroy/{idempleado}', [EmployeesController::class, 'destroy'])->name('employees.destroy');
Route::get('home/employees/edit/{idempleado}', [EmployeesController::class, 'edit'])->name('employees.edit');
Route::post('home/employees/update', [EmployeesController::class, 'update'])->name('employees.update');

//CLIENTES
Route::resource('home/clients','App\Http\Controllers\ClientsController');
Route::post('home/clients', [ClientsController::class, 'store'])->name('clients.store');
Route::get('home/clients/destroy/{idcliente}', [ClientsController::class, 'destroy'])->name('clients.destroy');
Route::get('home/clients/edit/{idcliente}', [ClientsController::class, 'edit'])->name('clients.edit');
Route::post('home/clients/update', [ClientsController::class, 'update'])->name('clients.update');

//PROVEEDORES
Route::resource('home/providers','App\Http\Controllers\ProvidersController');
Route::post('home/providers', [ProvidersController::class, 'store'])->name('providers.store');
Route::get('home/providers/destroy/{idproveedor}', [ProvidersController::class, 'destroy'])->name('providers.destroy');
Route::get('home/providers/edit/{idproveedor}', [ProvidersController::class, 'edit'])->name('providers.edit');
Route::post('home/providers/update', [ProvidersController::class, 'update'])->name('providers.update');

//CATEGORIAS
Route::resource('home/categories','App\Http\Controllers\CategoriesController');
Route::post('home/categories', [CategoriesController::class, 'store'])->name('categories.store');
Route::get('home/categories/destroy/{idcategoria}', [CategoriesController::class, 'destroy'])->name('categories.destroy');
Route::get('home/categories/edit/{idcategoria}', [CategoriesController::class, 'edit'])->name('categories.edit');
Route::post('home/categories/update', [CategoriesController::class, 'update'])->name('categories.update');

//PRODUCTOS
Route::resource('home/products','App\Http\Controllers\ProductsController');
Route::get('home/existproducts', [ProductsController::class, 'prod_existentes'])->name('existproducts.prod_existentes');
Route::post('home/products', [ProductsController::class, 'store'])->name('products.store');
Route::get('home/products/destroy/{idarticulo}', [ProductsController::class, 'destroy'])->name('products.destroy');
Route::get('home/products/edit/{idarticulo}', [ProductsController::class, 'edit'])->name('products.edit');
Route::post('home/products/update', [ProductsController::class, 'update'])->name('products.update');

//FACTURAS
Route::resource('home/bills','App\Http\Controllers\BillsController');
Route::get('home/dbills',[BillsController::class, 'billofday'])->name('dbills.billofday');
Route::get('home/mbills',[BillsController::class, 'billofmonth'])->name('mbills.billofmonth');
Route::get('home/bills/destroy/{idfactura}', [BillsController::class, 'destroy'])->name('bills.destroy');
Route::get('home/bills/show/{idfactura}', [BillsController::class, 'show'])->name('bills.show');

//ORDENES
Route::resource('home/orders','App\Http\Controllers\OrdersController');
Route::get('home/norders',[OrdersController::class, 'new_orders'])->name('norders.new_orders');
Route::post('home/norders', [OrdersController::class, 'store_orden'])->name('norders.store_orden');

Route::get('/home/norders/{id}/index',[OrdersController::class, 'detalle'])->name('norders.detalle_orden');
Route::get('/home/norders/{id}/variante',[OrdersController::class, 'gettalla']);
Route::get('/home/norders/{id}/colores',[OrdersController::class, 'getcolor']);
Route::post('/home/norders/{id}/index',[OrdersController::class, 'store_detalle'])->name('norders.new_detalle');



