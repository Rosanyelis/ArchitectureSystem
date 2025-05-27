<?php

namespace App\Http\Requests\DollarRate;

use Illuminate\Foundation\Http\FormRequest;

class StoreDollarRateRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'rate' => 'required|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'rate.required' => 'La tasa es requerida',
        ];
    }
}
