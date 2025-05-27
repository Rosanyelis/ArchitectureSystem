<?php

namespace App\Http\Requests\Projects;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'customer_id' => 'required|exists:customers,id',
            'budget_id' => 'required|exists:budgets,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'address' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'url_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre del proyecto es obligatorio',
            'name.max' => 'El nombre del proyecto no puede exceder los 255 caracteres',
            'description.required' => 'La descripción del proyecto es obligatoria',
            'budget_id.required' => 'Debe seleccionar un presupuesto',
            'budget_id.exists' => 'El presupuesto seleccionado no existe',
            'customer_id.required' => 'Debe seleccionar un cliente',
            'customer_id.exists' => 'El cliente seleccionado no existe',
            'address.required' => 'La dirección del proyecto es obligatoria',
            'address.max' => 'La dirección del proyecto no puede exceder los 255 caracteres',
            'location.required' => 'La ubicación del proyecto es obligatoria',
            'location.max' => 'La ubicación del proyecto no puede exceder los 255 caracteres',
            'province.required' => 'La provincia del proyecto es obligatoria',
            'province.max' => 'La provincia del proyecto no puede exceder los 255 caracteres',
            'start_date.required' => 'La fecha de inicio es obligatoria',
            'start_date.date' => 'La fecha de inicio debe ser una fecha válida',
            'end_date.required' => 'La fecha de finalización es obligatoria',
            'end_date.date' => 'La fecha de finalización debe ser una fecha válida',
            'end_date.after_or_equal' => 'La fecha de finalización debe ser igual o posterior a la fecha de inicio',
            'url_image.image' => 'El archivo debe ser una imagen',
            'url_image.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg, gif',
            'url_image.max' => 'La imagen no debe pesar más de 2MB'
        ];
    }
}
