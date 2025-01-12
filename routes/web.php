<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReadingController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/sensor/{sensorId}/readings', [ReadingController::class, 'chart'])->name('readings.chart');
Route::get('/sensor/{sensorId}/avg-readings', [ReadingController::class, 'averageChart'])->name('readings.avg-chart');