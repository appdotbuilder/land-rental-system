<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLandRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()?->isAdmin() ?? false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'area' => 'required|numeric|min:0.01',
            'area_unit' => 'required|string|in:acres,hectares,square_feet,square_meters',
            'description' => 'nullable|string',
            'status' => 'required|string|in:available,rented',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Land name is required.',
            'location.required' => 'Location is required.',
            'area.required' => 'Area size is required.',
            'area.min' => 'Area must be greater than 0.',
            'area_unit.required' => 'Area unit is required.',
            'area_unit.in' => 'Please select a valid area unit.',
            'status.required' => 'Status is required.',
            'status.in' => 'Please select a valid status.',
        ];
    }
}