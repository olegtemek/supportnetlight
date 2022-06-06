<?php

use App\Http\Controllers\AccessController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\SupportController;
use App\Models\Support;
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






Route::get('/', [MainController::class, 'index'])->name('home.index');
Route::post('/', [MainController::class, 'store'])->name('home.store');
Route::delete('/{id}', [MainController::class, 'destroy'])->name('home.destroy');
Route::put('/{id}', [MainController::class, 'update'])->name('home.update');

Route::get('/support/deleted', [SupportController::class, 'deleted'])->name('support.deleted');
Route::post('/support/deleted/{id}', [SupportController::class, 'restore'])->name('support.restore');
Route::get('/support/search', [SupportController::class, 'search'])->name('support.search');

Route::get('/support/export', [SupportController::class, 'export'])->name('support.export');
Route::resource('/support', SupportController::class, ['names' => 'support']);


Route::get('/access/export', [AccessController::class, 'export'])->name('access.export');
Route::get('/access/deleted', [AccessController::class, 'deleted'])->name('access.deleted');
Route::post('/access/deleted/{id}', [AccessController::class, 'restore'])->name('access.restore');
Route::get('/access/search', [AccessController::class, 'search'])->name('access.search');
Route::resource('/access', AccessController::class, ['names' => 'access']);

Route::resource('/status', StatusController::class);
