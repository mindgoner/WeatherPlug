<?php

namespace App\Http\Controllers\Add;

use Illuminate\Http\Request;
use App\Models\Sensor;
use App\Models\SensorGroup;
use App\Http\Requests\DeleteSensorRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddSensorRequest;
use App\Http\Requests\EditRequest;
use App\Http\Requests\RenameRequest;

class AddController extends Controller
{
    //Dodawanie sesnorów
    public function store(AddSensorRequest $request, $groupId)
    {
        
        $sensorId = $request->input('sensor_id');
       
        Sensor::where('id', $sensorId)->update(['sensorBelongsTo' => $groupId]);
    
        return redirect()->route('sensor_groups.index')->with('success', 'Sensor added to the group successfully');
    }

    //Edytowanie sensorów 
    public function edit(EditRequest $request)
    {
        $id=$request->input('id');
        // Znajdź grupę czujników na podstawie przekazanego ID
        $sensorGroup = SensorGroup::findOrFail($id);
    
        // Pobierz sensor przypisany do grupy
        $sensors = Sensor::where('sensorBelongsTo', $id)->get();
    
        return view('admin.sensorgroups.edit', compact('sensorGroup', 'sensors'));
    }

    //Zmiana nazwy grupy
    public function rename(RenameRequest $request, $id)
    {
        // Znajdź grupę czujników na podstawie przekazanego ID
        $sensorGroup = SensorGroup::findOrFail($id);

        // Walidacja formularza
        $request->validate([
            'sensorGroupName' => 'required|string|max:255',  ]);
    
        // Zaktualizuj nazwę grupy na podstawie wartości przesłanej z formularza
        $sensorGroup->sensorGroupName = $request->input('sensorGroupName');

        $sensorGroup->save();

        // Przekieruj użytkownika z powiadomieniem o sukcesie
        return redirect()->route('sensor_groups.edit', ['id' => $sensorGroup->id])->with('success', 'Sensor removed from group successfully');
    }

    //Wyświetlanie sesorów do dodania  
    public function addSensorsForm($id)
    {
        $sensorGroup = SensorGroup::findOrFail($id);

        // Pobierz wszystkie sensory, które jeszcze nie należą do żadnej grupy
        $availableSensors = Sensor::whereNull('sensorBelongsTo')->get();

        return view('admin.sensorgroups.addSensorsForm', compact('sensorGroup', 'availableSensors'));
    }

    //Usuwanie sensorów z danej grupy 
    public function removeSensor(DeleteSensorRequest  $request)
{
    $sensor = Sensor::where('id',$request->ToBeDelatedSensor)->first();

    $sensorGroup = SensorGroup::where('id', $sensor->sensorBelongsTo)->first();

    $sensor->update(['sensorBelongsTo' => null]);
   
    return redirect()->route('sensor_groups.edit',["id" =>$sensorGroup->id] )->with('success', 'Sensor removed from group successfully');
}


}
