<?php

namespace App\Http\Requests\Property;

use Illuminate\Foundation\Http\FormRequest;

class ContactInformationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'setting_type' => 'required|string|in:author,agent,none',
            'agents' => 'nullable|array',
            'agents.*' => 'integer', // Assuming agent IDs are integers
        ];
        
    }
}
