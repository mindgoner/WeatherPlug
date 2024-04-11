<?php

namespace App\Http\Controllers\SensorGroup;

use App\Models\SensorGroup;
use Illuminate\Http\Request;
use App\Http\Requests\CreateSensorGroupRequest;
use App\Http\Requests\DeleteSensorGroupRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddSensorRequest;
use App\Http\Requests\ViewRequest;
use App\Models\Sensor;

class SensorGroupController extends Controller
{
    //Widok strony z grupami sensorów 
    public function index()
    {
        if (Auth::id() !== null) {

            $user = Auth::user();

            $sensorGroups = SensorGroup::where('sensorGroupOwner', $user->id)->get();

            return view('admin.sensorgroups.sensorGroupView', compact('sensorGroups'));

        }else {

            return redirect()->route('login'); // Przekierowanie do strony logowania
        }
    }


    public function create()
    {
        
        return view('admin.sensorgroups.sensorGroupCreate');
    }

    //Display grup sensorów
    public function show( $groupId)
    {
        if (Auth::id() !== null) {

        // Znajdź grupę sensorów na podstawie przekazanego ID
        $sensorGroup = SensorGroup::findOrFail($groupId);
        
        // Znajdź sensory przypisane do tej grupy
        $sensors = Sensor::where('sensorBelongsTo', $groupId)->get();
        
        // Przekazanie danych do widoku
        return view('admin.sensorgroups.show', compact('sensorGroup', 'sensors' ));
        
        }else {

            return redirect()->route('login'); // Przekierowanie do strony logowania
        }
    }

    //Dodawanie grup sensorów
    public function store(CreateSensorGroupRequest $request)
    {
            // Użytkownik ma uprawnienia do tworzenia grup sensorów

            $request->merge(['sensorGroupOwner'=>auth()->user()->id]);

            $sensorGroup = new SensorGroup;

            $sensorGroup->fill($request->all());
            
            $sensorGroup->save();

            return redirect()->route('sensor_groups.index')->with('success', 'Sensor group created successfully');
        
    }


    public function deleteForm()
    {
        return view('sensor_groups.delete');
    }

    //Usuwanie grup sensorów i update przynależności sensorBelongsTo
    public function destroy(DeleteSensorGroupRequest $request)
    {
        // Sprawdź, czy użytkownik jest właścicielem grupy czujników
        $sensorGroup = SensorGroup::where('id', $request->ToBeDelated)
                                    ->where('sensorGroupOwner', auth()->user()->id)
                                    ->first();
    
        // Jeśli grupa czujników istnieje i użytkownik jest jej właścicielem, usuń ją
        Sensor::where('sensorBelongsTo', $sensorGroup->id)->update(['sensorBelongsTo' => null]);

            $sensorGroup->delete();

            return redirect()->route('sensor_groups.index')->with('success', 'Sensor group deleted successfully');
        
    }

    //Dodawanie sensorów 
    public function addSensorsForm(AddSensorRequest $id)
    {
        $sensorGroup = SensorGroup::findOrFail($id);

        // Pobierz wszystkie sensory, które jeszcze nie należą do żadnej grupy
        $availableSensors = Sensor::whereNull('sensorBelongsTo')->get();

        return view('admin.sensorgroups.addSensorsForm', compact('sensorGroup', 'availableSensors'));
    }
    

}
