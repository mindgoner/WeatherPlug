<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSensorGroupRequest extends FormRequest
{

    public function authorize(): bool
    {
        // Sprawdź, czy użytkownik jest zalogowany
        if (!auth()->check()) {
             return false;
        }
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'sensorGroupName' => 'required|string|max:20|min:3',

        ];
    }

    public function messages()
    {
        return [
            'sensorGroupName.required' => 'Nazwa grupy sensorów jest wymagana.',
            'sensorGroupName.string' => 'Nazwa grupy sensorów musi być ciągiem znaków.',
            'sensorGroupName.max' => 'Nazwa grupy sensorów nie może przekraczać :max znaków.',
            // Możesz dodać inne komunikaty o błędach tutaj dla innych pól
        ];
    }
}
