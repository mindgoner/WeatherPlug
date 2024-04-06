<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sensor;
use App\Models\Readings;

use App\Http\Requests\DataRequestValidator;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
    }

    /**
     * Display the specified resource.
     */
    public function show(DataRequestValidator $request)
    {
        // Pobranie danych temperatury 
        $deviceId = $request->deviceId;
        $readings = Readings::where('deviceid','=', $deviceId);

        $toBeDisplayed = [];
        if(!is_null($request->display)){
            foreach (json_decode($request->display) as $display) {
                $toBeDisplayed[$display] = $readings->get([$display])->pluck($display);
            }
        }else{
            // Wyświetl samą temperaturę, jeżeli nie zdefininowano
            $toBeDisplayed['Temperatura'] = $readings->get(['Temperatura'])->pluck('Temperatura');
        }

        $timestampsPluck = $readings->get('created_at')->pluck('created_at');

        $timestamps = [];
        foreach ($timestampsPluck as $timestamp) {
            $timestamps[] = date("H:i:s", strtotime($timestamp)); // Konwersja na format zrozumiały dla JavaScript
        }

        // Wygenerowanie wykresu
        return view('wykres', [
            'temperatures' => isset($toBeDisplayed['Temperatura']) ? $toBeDisplayed['Temperatura'] : null,
            'pressures' => isset($toBeDisplayed['Cisnienie']) ? $toBeDisplayed['Cisnienie'] : null,
            'humidities' => isset($toBeDisplayed['Wilgotnosc']) ? $toBeDisplayed['Wilgotnosc'] : null,
            'timestamps' => $timestamps
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
