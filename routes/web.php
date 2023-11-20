<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


Route::get('role',[App\Http\Controllers\RoleController::class,'index'])->name('roleIndex');
Route::get('role/create',[App\Http\Controllers\RoleController::class,'create'])->name('roleCreate');
Route::post('role',[App\Http\Controllers\RoleController::class,'store'])->name('roleStore');
Route::get('role/{id}',[App\Http\Controllers\RoleController::class,'edit'])->name('roleEdit');
Route::put('role/{id}',[App\Http\Controllers\RoleController::class,'update'])->name('roleUpdate');
Route::delete('role/{id}',[App\Http\Controllers\RoleController::class,'destroy'])->name('roleDelete');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
