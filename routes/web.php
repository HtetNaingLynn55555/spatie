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






// Route::get('users/create',[App\Http\Controllers\UserController::class,'crate]')

Route::get('/home', [HomeController::class, 'index'])->name('home');



Route::group(['middleware' => ['auth']], function() {



    Route::group(['middleware'=> ['role:superadmin'] ], function(){
    Route::get('role',[App\Http\Controllers\RoleController::class,'index'])->name('roleIndex');
    Route::get('role/create',[App\Http\Controllers\RoleController::class,'create'])->name('roleCreate');
    Route::post('role',[App\Http\Controllers\RoleController::class,'store'])->name('roleStore');
    Route::get('role/{id}',[App\Http\Controllers\RoleController::class,'edit'])->name('roleEdit');
    Route::put('role/{id}',[App\Http\Controllers\RoleController::class,'update'])->name('roleUpdate');
    Route::delete('role/{id}',[App\Http\Controllers\RoleController::class,'destroy'])->name('roleDelete');
   });

    Route::get('users',[App\Http\Controllers\UserController::class,'index'])->name('userIndex');

    Route::get('users/create',[App\Http\Controllers\UserController::class,'create'])->name('userCreate');
    Route::post('users',[App\Http\Controllers\UserController::class,'store'])->name('userStore');
    Route::get('users/{id}',[App\Http\Controllers\UserController::class,'edit'])->name('userEdit');
    Route::put( 'users/{id}',[App\Http\Controllers\UserController::class,'update'])->name('userUpdate');
    Route::delete('users/{id}',[App\Http\Controllers\UserController::class,'destroy'])->name('userDelete');

});

Auth::routes([ 'register'=>false ]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
