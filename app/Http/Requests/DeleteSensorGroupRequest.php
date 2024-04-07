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
        // Sprawdzamy, czy użytkownik jest zalogowany
        return auth()->check();
    }


    public function rules(): array
    {
        return [
            'ToBeDelated'=>'required|int|exists:sensorgroup,id'
        ];
    }
}
