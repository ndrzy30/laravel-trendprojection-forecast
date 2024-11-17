<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PredictController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\TrainingController;
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

Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('medicine', ObatController::class);
    Route::post('import-medicine', [ObatController::class, 'imports'])->name('import-medicine');
    Route::resource('sales', SaleController::class);
    // Route::get('report', [ReportController::class, 'index'])->name('report');
    Route::post('import-sales', [SaleController::class, 'imports'])->name('import-sales');
    Route::get('drop', [SaleController::class, 'reset'])->name('reset');

    // Training route
    Route::get('train-data', [TrainingController::class, 'index'])->name('train.index');
    Route::get('data-trend', [TrainingController::class, 'calculate'])->name('train.store');
    // Predict route
    Route::get('predict', [PredictController::class, 'index'])->name('predict.index');
    Route::post('predict-data', [PredictController::class, 'predict'])->name('predict.store');
});

Route::get('/', [LoginController::class, 'index'])->name('home')->middleware('guest');
Route::post('authentication', [LoginController::class, 'auth'])->name('auth')->middleware('guest');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');