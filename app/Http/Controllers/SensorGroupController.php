<?php

namespace App\Http\Controllers;


use App\Models\SensorGroup;
use App\Http\Requests\CreateSensorGroupRequest;
use App\Http\Requests\DeleteSensorGroupRequest;
use Illuminate\Support\Facades\Auth;

class SensorGroupController extends Controller
{

    public function index()
    {
        if (Auth::id() !== null) {
            $user = Auth::user();
            $sensorGroups = SensorGroup::where('sensorGroupOwner', $user->id)->get();
            return view('admin.sensorgroups.sensorGroupView', compact('sensorGroups'));
        } else {
            return redirect()->route('login'); // Przekierowanie do strony logowania
        }
    }


    public function create()
    {
        
        return view('admin.sensorgroups.sensorGroupCreate');
    }



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


    public function destroy(DeleteSensorGroupRequest $request)
    {
    
        // Sprawdź, czy użytkownik jest właścicielem grupy czujników
        $sensorGroup = SensorGroup::where('id', $request->ToBeDelated)
                                    ->where('sensorGroupOwner', auth()->user()->id)
                                    ->first();
    
        // Jeśli grupa czujników istnieje i użytkownik jest jej właścicielem, usuń ją
        
            $sensorGroup->delete();
            return redirect()->route('sensor_groups.index')->with('success', 'Sensor group deleted successfully');
        
    }

}
