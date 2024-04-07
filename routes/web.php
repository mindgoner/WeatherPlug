<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DataController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SensorGroupController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/wykres', [DataController::class, 'show'])->name('pokazWykres');

Route::get('/sensor_groups', [SensorGroupController::class, 'index'])->name('sensor_groups.index');

Route::get('/sensor_groups/create', [SensorGroupController::class, 'create'])->name('sensor_groups.create')->middleware('auth');

Route::post('/sensor_groups', [SensorGroupController::class, 'store'])->name('sensor_groups.store');


Route::delete('/sensor_groups/{sensor_group}', [SensorGroupController::class, 'destroy'])->name('sensor_groups.destroy');
