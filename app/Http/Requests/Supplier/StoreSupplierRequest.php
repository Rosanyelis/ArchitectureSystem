<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupplierRequest extends FormRequest
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
            'razon_social' => 'required|string|max:255',
            'cuit' => 'required|string|max:20',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'correo' => 'required|email|max:255',
            'domicilio' => 'required|string|max:255',
            'localidad' => 'required|string|max:255',
            'provincia' => 'required|string|max:255',
        ];
    }


    public function messages(): array
    {
        return [
            'razon_social.required' => 'La razón social es obligatoria.',
            'razon_social.string' => 'La razón social debe ser una cadena de texto.',
            'razon_social.max' => 'La razón social no puede tener más de 255 caracteres.',
            'cuit.required' => 'El CUIT es obligatorio.',
            'cuit.string' => 'El CUIT debe ser una cadena de texto.',
            'cuit.max' => 'El CUIT no puede tener más de 20 caracteres.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'nombre.required' => 'El nombre es obligatorio.',
            'apellido.required' => 'El apellido es obligatorio.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'correo.required' => 'El correo electrónico es obligatorio.',
            'domicilio.required' => 'El domicilio es obligatorio.',
            'localidad.required' => 'La localidad es obligatoria.',
            'provincia.required' => 'La provincia es obligatoria.',
        ];
    }
}
