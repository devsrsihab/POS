<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\admin\EmployeController;
use App\Http\Controllers\admin\DashboardController;

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
});

//Auth
Route::get('/login',[AuthController::class,'login'])->name('login');
//login action
Route::post('/login',[AuthController::class,'loginAction'])->name('login');
//login action
Route::get('/logout',[AuthController::class,'logOut'])->name('logOut');
//make user
Route::get('/makeUser',[AuthController::class,'makeUser'])->name('makeUser');