<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AhliGiziController;
use App\Http\Controllers\BidanController;
use App\Http\Controllers\KapusController;
use App\Http\Controllers\PosyanduController;
use App\Http\Controllers\BalitaController;
use App\Http\Controllers\KaderController;
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
    return redirect('login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('user')->group(function () {
    Route::prefix('ahli_gizi')->group(function () {
        Route::get('/', [AhliGiziController::class, 'index']);
        Route::get('/create', [AhliGiziController::class, 'create']);
        Route::get('/edit/{id}', [AhliGiziController::class, 'edit']);
        Route::get('/delete/{id}', [AhliGiziController::class, 'delete']);
        Route::post('/store', [AhliGiziController::class, 'store']);
        Route::post('/update/{id}', [AhliGiziController::class, 'update']);
    });
    Route::prefix('bidan')->group(function () {
        Route::get('/', [BidanController::class, 'index']);
        Route::get('/create', [BidanController::class, 'create']);
        Route::get('/edit/{id}', [BidanController::class, 'edit']);
        Route::get('/delete/{id}', [BidanController::class, 'delete']);
        Route::post('/store', [BidanController::class, 'store']);
        Route::post('/update/{id}', [BidanController::class, 'update']);
    });
    Route::prefix('kapus')->group(function () {
        Route::get('/', [KapusController::class, 'index']);
        Route::get('/create', [KapusController::class, 'create']);
        Route::get('/edit/{id}', [KapusController::class, 'edit']);
        Route::get('/delete/{id}', [KapusController::class, 'delete']);
        Route::post('/store', [KapusController::class, 'store']);
        Route::post('/update/{id}', [KapusController::class, 'update']);
    });
});

Route::prefix('data')->group(function () {
    Route::prefix('posyandu')->group(function () {
        Route::get('/', [PosyanduController::class, 'index']);
        Route::get('/create', [PosyanduController::class, 'create']);
        Route::get('/edit/{id}', [PosyanduController::class, 'edit']);
        Route::get('/delete/{id}', [PosyanduController::class, 'delete']);
        Route::get('/kader/{id}', [PosyanduController::class, 'kader']);
        Route::post('/store', [PosyanduController::class, 'store']);
        Route::post('/kader_store', [PosyanduController::class, 'kaderStore']);
        Route::post('/update/{id}', [PosyanduController::class, 'update']);
    });
    Route::prefix('balita')->group(function () {
        Route::get('/', [BalitaController::class, 'index']);
        Route::get('/create', [BalitaController::class, 'create']);
        Route::get('/edit/{id}', [BalitaController::class, 'edit']);
        Route::get('/delete/{id}', [BalitaController::class, 'delete']);
        Route::post('/store', [BalitaController::class, 'store']);
        Route::post('/update/{id}', [BalitaController::class, 'update']);
    });
    Route::prefix('kader')->group(function () {
        Route::get('/', [KaderController::class, 'index']);
        Route::get('/create', [KaderController::class, 'create']);
        Route::get('/edit/{id}', [KaderController::class, 'edit']);
        Route::get('/delete/{id}', [KaderController::class, 'delete']);
        Route::post('/store', [KaderController::class, 'store']);
        Route::post('/update/{id}', [KaderController::class, 'update']);
    });
});