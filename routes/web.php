<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Sensor;
use App\Models\Readings;


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
    $Readings = new Readings();
    $Readings->deviceId = $Sensor->id;
    $Readings->Temperatura = $request->input('Temperatura');
    $Readings->Cisnienie = $request->input('Cisnienie');
    $Readings->Wilgotnosc = $request->input('Wilgotnosc');
    
    
    
    
    $Readings->save();
    
    return response()->json($request->all());

});
Route::get('/wykres/{deviceId}', function ($deviceId) {
    // Pobranie danych temperatury 
    $readings = Readings::where('deviceid','=', $deviceId)->get(['Temperatura','Cisnienie', 'Wilgotnosc', 'created_at']);

    $temperatures = [];
    $pressures = [];
    $humidities = [];
    $timestamps = [];

    foreach ($readings as $reading) {
        $temperatures[] = $reading->Temperatura;
        $pressures[] = $reading->Cisnienie;
        $humidities[] = $reading->Wilgotnosc;
        $timestamps[] = $reading->created_at->format('Y-m-d H:i:s'); // Konwersja na format zrozumiały dla JavaScript
    }

    // Wygenerowanie wykresu
    return view('wykres', compact('temperatures', 'pressures', 'humidities', 'timestamps'));
});