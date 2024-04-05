<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Sensor;
use App\Models\Odczyt;

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

Route::get('/collector', function (Request $request) {

    $Sensor = Sensor::where('deviceMac','=',$request->input('deviceMac'))->first();

    if ($Sensor==NULL){
        $Sensor = new Sensor();
        $Sensor->deviceMac = $request->input('deviceMac');
        $Sensor->save();
    }

    // Dopisać zbieranie odczytów (w zależności od godziny)
    $Odczyt = new Odczyt();
    $Odczyt->deviceId = $Sensor->id;
    $Odczyt->Temperatura = $request->input('Temperatura');
    $Odczyt->Cisnienie = $request->input('Cisnienie');
    $Odczyt->Wilgotnosc = $request->input('Wilgotnosc');
    
    
    $Odczyt->save();
    
    return response()->json($request->all());

});
Route::get('/wykres/{deviceId}', function ($deviceId) {
dd('test');
});