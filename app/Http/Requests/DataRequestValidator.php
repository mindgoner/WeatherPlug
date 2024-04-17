<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\SensorGroup;
use App\Models\Sensor;
use App\Models\user_group_relations;
use Illuminate\Support\Facades\Auth;

class DataRequestValidator extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Sprawdź, czy użytkownik jest zalogowany
        if (!auth()->check()) {
            return false;
        }


        $deviceId = $this->deviceId;
        $userId = Auth::id();
        $helperId = Sensor::find($deviceId);
        $desiredColumnValue = $helperId->sensorBelongsTo;
        $ghelperId = SensorGroup::find($desiredColumnValue);
        $desiredColumnOwner= $ghelperId->sensorGroupOwner;
        $addedUser= user_group_relations::where('userId', $userId)->pluck('groupId')->firstOrFail();

        
        

        if($userId==$desiredColumnOwner || $addedUser==$desiredColumnValue ){
            return true;
        }
        
        
        return false;
       
 
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            "deviceId" => "required|min:1|exists:sensors,id",
            "display" => "nullable|string",
        ];
    }
}
