<?php

namespace App\Http\Controllers\SensorGroup;

use App\Models\SensorGroup;
use App\Http\Requests\CreateSensorGroupRequest;
use App\Http\Requests\DeleteSensorGroupRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddSensorRequest;
use App\Models\Sensor;
use App\Models\user_group_relations;

class SensorGroupController extends Controller
{
    // Widok strony z grupami sensorów 
    public function index()
    {
        if (Auth::id() !== null) {
            $user = Auth::user();
    
            // Pobieramy grupy, których użytkownik jest właścicielem
            $sensorGroupsOwned = SensorGroup::where('sensorGroupOwner', $user->id)->get();
    
            // Pobieramy groupId użytkownika, który został dodany do grup
            $helpunio = Auth::user()->id;
            $helperSenor = user_group_relations::where("userId", $helpunio)->pluck('groupId')->toArray();
    
            // Łączymy obie kolekcje
            $sensorGroups = $sensorGroupsOwned->merge(SensorGroup::whereIn('id', $helperSenor)->get());
    
            return view('admin.sensorgroups.sensorGroupView', compact('sensorGroups'));
        } else {
            return redirect()->route('login'); // Przekierowanie do strony logowania
        }
    }


    public function create()
    {
        return view('admin.sensorgroups.sensorGroupCreate');
    }

    // Display grup sensorów
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

    // Dodawanie grup sensorów oraz nadawanie admina w relacjach z grupami (uzupełnianie funkcji)
    public function store(CreateSensorGroupRequest $request)
    {
            // Użytkownik ma uprawnienia do tworzenia grup sensorów
            $loggedInUserId = Auth::id();

            $request->merge(['sensorGroupOwner'=>auth()->user()->id]);
            
            $sensorGroup = new SensorGroup;

            $sensorGroup->fill($request->all());
            
            $sensorGroup->save();

            // Przypisywanie jako admin przy tworzeniu grupy
            $newGroupId = $sensorGroup->id;

            $sensorRelation = new user_group_relations();

            $sensorRelation->userId = $loggedInUserId;

            $sensorRelation->groupId = $newGroupId;

            $sensorRelation->status ="admin";

            $sensorRelation->save();
           
            return redirect()->route('sensor_groups.index')->with('success', 'Sensor group created successfully');
        
    }

    public function deleteForm()
    {
        return view('sensor_groups.delete');
    }

    // Usuwanie grup sensorów, update przynależności sensorBelongsTo oraz usuwwanie z colaboration (uzupełnianie funkcji)
    public function destroy(DeleteSensorGroupRequest $request)
    {
        // Sprawdź, czy użytkownik jest właścicielem grupy czujników
        $sensorGroupId = $request->ToBeDelated;
        $sensorGroup = SensorGroup::where('id', $request->ToBeDelated)
                                    ->where('sensorGroupOwner', auth()->user()->id)
                                    ->first();
    
        // Jeśli grupa czujników istnieje i użytkownik jest jej właścicielem, usuń ją
        if (is_null($sensorGroup)) {
            return redirect()->route('sensor_groups.index')->with('error', 'You are not the owner of this group');
        }

        // Usuwanie z colaboration
        user_group_relations::where('groupId', $sensorGroupId)->delete();

        // Usuwanie przynależnoći 
        Sensor::where('sensorBelongsTo', $sensorGroup->id)->update(['sensorBelongsTo' => null]);
    
        $sensorGroup->delete();
    
        return redirect()->route('sensor_groups.index')->with('success', 'Sensor group deleted successfully');
    }
    
    // Dodawanie sensorów 
    public function addSensorsForm(AddSensorRequest $id)
    {
        $sensorGroup = SensorGroup::findOrFail($id);

        // Pobierz wszystkie sensory, które jeszcze nie należą do żadnej grupy
        $availableSensors = Sensor::whereNull('sensorBelongsTo')->get();

        return view('admin.sensorgroups.addSensorsForm', compact('sensorGroup', 'availableSensors'));
    }
    

}
