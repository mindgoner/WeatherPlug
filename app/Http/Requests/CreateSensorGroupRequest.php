<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSensorGroupRequest extends FormRequest
{

    public function authorize()
    {
        // Tutaj możesz zdefiniować politykę autoryzacji, która sprawdzi, czy użytkownik ma uprawnienia do tworzenia grup sensorów.
        // Na przykład, jeśli masz zdefiniowaną politykę autoryzacji, możesz użyć metody can() do sprawdzenia uprawnień.
        // return $this->user()->can('create-sensor-group');
        return true; // Dla przykładu zwracamy zawsze true, ale należy dostosować to do rzeczywistych wymagań autoryzacji.
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
