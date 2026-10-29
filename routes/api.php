<?php

use App\Http\Controllers\Api\CuacaController;
use App\Http\Controllers\Api\LaporanController;
use App\Http\Controllers\Api\StatistikController;
use Illuminate\Support\Facades\Route;

Route::apiResource('laporan', LaporanController::class);
Route::get('statistik', StatistikController::class);
Route::get('cuaca', CuacaController::class);
