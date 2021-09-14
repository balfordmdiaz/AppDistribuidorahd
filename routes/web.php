<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\ProvidersController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\BillsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\UserfactController;
use App\Http\Controllers\UseradminController;
use App\Http\Controllers\ControllerDetalleVenta;
use App\Http\Controllers\ControllerDetalleCompra;
use App\Http\Controllers\SearchController;

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

//EMPLEADOS



Route::middleware(['auth'])->group(function ()
{

    //rutas para el controlador employees
    //Route::get('employees',[EmployeesController::class, 'index'])->name('employees.index');
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
    Route::get('home/newproduct', [ProductsController::class, 'newprod'])->name('newproduct.newprod');
    Route::post('home/newproduct', [ProductsController::class, 'store'])->name('newproduct.store');
    Route::post('home/newproduct', [ProductsController::class, 'storeVariant'])->name('newproduct.storeVariant');
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
    Route::get('home/orders/destroy/{idorden}', [OrdersController::class, 'destroy'])->name('orders.destroy');
    Route::get('home/orders/show/{idorden}', [OrdersController::class, 'show'])->name('orders.show');
   
    Route::post('/home/orders', [OrdersController::class, 'store_newprod'])->name('norders.store_newprod');
    Route::get('/home/norders/{id}/index',[OrdersController::class, 'detalle'])->name('norders.detalle_orden');
    Route::get('/home/norders/{id}/articulo', [SearchController::class, 'articulo'])->name('search.articulo');
    Route::get('/home/norders/{id}/variante',[OrdersController::class, 'gettalla']);
    Route::get('/home/norders/{id}/colores',[OrdersController::class, 'getcolor']);
    Route::get('/home/norders/{id}/precio',[OrdersController::class, 'getprecio']);
    Route::get('/home/norders/{id}/tipo',[OrdersController::class, 'gettipo']);
    Route::post('/home/norders/{id}/index',[OrdersController::class, 'store_detalle'])->name('norders.new_detalle');
    Route::delete('/home/norders/{id}/{idordendetalle}', [OrdersController::class, 'delete_register'])->name('norders.delete_register');
    Route::get('/home/norders/{id}/index/details',[OrdersController::class, 'show_detalleorden'])->name('norders.showdetalle');

    //Usuarios Facturas
    Route::resource('home/userfacts','App\Http\Controllers\UserfactController');
    Route::post('/home/userfacts', [UserfactController::class, 'store'])->name('userfacts.store');

    //Usuarios Admin
    Route::resource('home/useradmin','App\Http\Controllers\UseradminController');
    Route::post('/home/useradmin', [UseradminController::class, 'store'])->name('useradmin.store');

    //Detalle venta
    Route::get('home/detalle/semanal', [ControllerDetalleVenta::class, 'index'])->name('detalle.semana');
    Route::get('home/detalle/semanaante', [ControllerDetalleVenta::class, 'anterior'])->name('detalle.semanaante');
    Route::get('home/detalle/semanaante_pasada', [ControllerDetalleVenta::class, 'ante_pasada'])->name('detalle.semanaante_pasada');
    Route::get('home/detalle/general', [ControllerDetalleVenta::class, 'general'])->name('detalle.general');

    //Detalle Compra
    Route::get('home/detallec/semanal', [ControllerDetalleCompra::class, 'index'])->name('detallec.semana');
    Route::get('home/detallec/semanaante', [ControllerDetalleCompra::class, 'anterior'])->name('detallec.semanaante');
    Route::get('home/detallec/semanaante_pasada', [ControllerDetalleCompra::class, 'ante_pasada'])->name('detallec.semanaante_pasada');
    Route::get('home/detallec/ordengeneral', [ControllerDetalleCompra::class, 'ordengeneral'])->name('detallec.ordengeneral');


});






