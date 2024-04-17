<?php

use App\Http\Controllers\Add\AddController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Data\DataController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SensorGroup\SensorGroupController;
use App\Http\Controllers\relations\user_group_relationsController;

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

Route::get('/sensor_groups/edit', [AddController::class, 'edit'])->name('sensor_groups.edit');

Route::get('/sensor_groups/{id}/add_sensors_form', [AddController::class, 'addSensorsForm'])->name('sensor_groups.add_sensors_form');

Route::post('/sensor_groups/{id}/add_sensors', [AddController::class, 'store'])->name('sensor_groups.add_sensors');

Route::get('/sensor_groups/{groupId}/view_added_sensors', [SensorGroupController::class, 'show'])
    ->name('sensor_groups.show_added_sensors');

Route::put('/sensor_groups/{id}', [AddController::class, 'update'])->name('sensor_groups.update');

Route::delete('/sensor_groups/{id}/remove_sensor', [AddController::class, 'removeSensor'])->name('sensor_groups.remove_sensor');

Route::post('/sensor_groups/rename/{id}', [AddController::class, 'rename'])->name('sensor_groups.rename');

Route::get('/relations/create', [user_group_relationsController::class, 'create'])->name('relations.create');

Route::get('/relations/show', [user_group_relationsController::class, 'show'])->name('relations.show');

Route::post('/relations/add', [user_group_relationsController::class, 'addMember'])->name('relations.add');

Route::get('/sensor_groups/edit_members', [user_group_relationsController::class, 'removeUserFromColabsShow'])->name('relations.show_members');

Route::delete('/users/{id}', [user_group_relationsController::class, 'deleteUser'])->name('delete_user');