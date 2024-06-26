<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteSensorGroupRequest extends FormRequest
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

 
        return True;
    }


    public function rules(): array
    {
        return [
            'ToBeDelated'=>'required|int|exists:sensorgroups,id'
        ];
    }
}
