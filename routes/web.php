<?php

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

Route::get('/', [App\Http\Controllers\inmobilariaController::class, 'home']);

Route::post('/procesar-ficha', [App\Http\Controllers\inmobilariaController::class, 'procesarFicha'])->name('procesar');
Route::post('/generar-ficha', [App\Http\Controllers\fichaController::class, 'generar'])->name('generar');
Route::post('/crear-directorio', [App\Http\Controllers\inmobilariaController::class, 'directory'])->name('crear-directorio');
Route::post('/upload-image', [App\Http\Controllers\ImageController::class, 'uploadImage'])->name('images.upload');
