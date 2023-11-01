<?php

use App\Http\Controllers\DataController;
use App\Http\Controllers\EpubController;
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
    return view('index');
});

Route::get('/epub', [EpubController::class, 'index'])->name('epub.index');
Route::get('/epub/process/{id}', [EpubController::class, 'processEbook'])->name('epub.process');
Route::get('/data', [DataController::class, 'index'])->name('data.index');
