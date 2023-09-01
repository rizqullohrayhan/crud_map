<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TitikController;
use App\Http\Controllers\GarisController;
use App\Http\Controllers\RefPolygonController;

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

Route::get('/', function () {
    return redirect()->route('titik');
});

Route::prefix('titik')
    ->name('titik')
    ->group(function () {
        Route::get('/', [TitikController::class, 'index']);
        Route::post('/tambah', [TitikController::class, 'tambah'])->name('.tambah');
        Route::put('edit/{id}', [TitikController::class, 'update'])->name('.edit');
        Route::delete('/hapus/{id}', [TitikController::class, 'destroy'])->name('.hapus');
});

Route::prefix('garis')
    ->name('garis')
    ->group(function () {
        Route::get('/', [GarisController::class, 'index']);
        Route::post('/tambah', [GarisController::class, 'tambah'])->name('.tambah');
        Route::put('edit/{id}', [GarisController::class, 'update'])->name('.edit');
        Route::delete('/hapus/{id}', [GarisController::class, 'destroy'])->name('.hapus');
});

Route::prefix('polygon')
    ->name('polygon')
    ->group(function () {
        Route::get('/', [RefPolygonController::class, 'index']);
        Route::post('/tambah', [RefPolygonController::class, 'tambah'])->name('.tambah');
        Route::put('/edit/{id}', [RefPolygonController::class, 'updateRefPolygon'])->name('.edit');
        Route::delete('/hapus/{id}', [RefPolygonController::class, 'destroy'])->name('.hapus');
});