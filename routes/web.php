<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/',[App\Http\Controllers\PuntosAnclajeController::class, 'showByReference'])->name('welcome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

// Route::get('/puntoAnclaje/{precinto}', [App\Http\Controllers\PuntosAnclajeController::class, 'show']);
Route::get('/registrarPuntoAnclaje', [App\Http\Controllers\PuntosAnclajeController::class, 'create'])->middleware('auth');
Route::get('/obtenerPuntosDeAnclaje', [App\Http\Controllers\PuntosAnclajeController::class, 'index'])->middleware('auth');
Route::post('/insertarPuntoAnclaje' ,[App\Http\Controllers\PuntosAnclajeController::class,'store'])->name('insertarPuntoAnclaje')->middleware('auth');
Route::get('/editarPuntoAnclaje/{id}', [App\Http\Controllers\PuntosAnclajeController::class,'edit'])->name('editarEmpresa');
Route::put('/actualizarPuntoAnclaje/{id}', [App\Http\Controllers\PuntosAnclajeController::class,'update'])->name('actualizarPuntoAnclaje');
Route::get('/registrarEmpresa', [App\Http\Controllers\PuntosAnclajeController::class, 'registerCompany'])->middleware('auth');
Route::post('/insertarEmpresa', [App\Http\Controllers\PuntosAnclajeController::class, 'insertCompany'])->name('insertarEmpresa')->middleware('auth');
Route::get('/exportar', [App\Http\Controllers\PuntosAnclajeController::class, 'export'])->middleware('auth');
