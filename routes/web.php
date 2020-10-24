<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeesController;

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
