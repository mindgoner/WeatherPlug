<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;

class StoreReadingRequest extends FormRequest
{
    public function authorize(){
        return true;
    }
    public function rules(){
        return [
            'deviceMac' => 'required|string',
            'temperature' => 'required|numeric',
            'humidity' => 'nullable|numeric',
        ];
    }
    protected function failedValidation(Validator $validator){
        $response = response()->json([
            'success' => false,
            'errors' => $validator->errors(),
        ], 422);
        throw new ValidationException($validator, $response);
    }
}
