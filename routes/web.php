<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\CustomerController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\admin\EmployeController;
use App\Http\Controllers\admin\ExpenseController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\SupplierController;
use App\Http\Controllers\admin\CategorieController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\AdvanceSalaryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// admin dashboard
Route::middleware(['adminAuth'])->group(function(){
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::resource('/employees',EmployeController::class);
    Route::resource('/suppliers',SupplierController::class);
    Route::resource('/customers',CustomerController::class);
    Route::resource('/advanceSalaries',AdvanceSalaryController::class);
    Route::resource('/categories',CategorieController::class);
    Route::resource('/products',ProductController::class);
});

//Auth
Route::get('/login',[AuthController::class,'login'])->name('login');
//login action
Route::post('/login',[AuthController::class,'loginAction'])->name('login');
//login action
Route::get('/logout',[AuthController::class,'logOut'])->name('logOut');
//make user
Route::get('/makeUser',[AuthController::class,'makeUser'])->name('makeUser');


//learn hunter tutorial Number: 20