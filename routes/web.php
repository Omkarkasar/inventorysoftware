<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
// use App\Http\Controllers\ProductController;
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

Route::get('/', [HomeController::class, 'index'])->name('index');
// Route::post('productstore',[ProductController::class,'productstore'])->name('productstore');
// Route::get('productget',[ProductController::class,'productget'])->name('productget');
// Route::get('productedit/{id}',[ProductController::class,'productedit'])->name('productedit');
// Route::post('productupdate/{id}',[ProductController::class,'productupdate'])->name('productupdate');
// Route::delete('productdelete/{id}',[ProductController::class,'productdelete'])->name('productdelete');

//Client
Route::post('clientstore', [ClientController::class, 'clientstore'])->name('clientstore');
