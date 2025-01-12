<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReadingController;

Route::group(['prefix' => '/v1'], function () {

    Route::get('/data-receiver', [ReadingController::class, 'store']);
    Route::get('/sensor/{sensorId}/raw-readings', [ReadingController::class, 'readings'])->name('api.sensor.raw-readings');
    Route::get('/sensor/{sensorId}/avg-raw-readings', [ReadingController::class, 'avgReadings'])->name('api.sensor.avg-raw-readings');

});