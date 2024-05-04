<?php

namespace App\Http\Requests;

class StoreUserRequest extends RegisterRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            ...parent::rules(),
            'admin' => 'sometimes|boolean'
        ];
    }
}
