<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        if ($this->isMethod('post')) {
            return [
                'name'  => 'required|string|max:255',
                'price' => 'required|numeric|min:0.01',
                'stock' => 'required|integer|min:0',
            ];
        }

        // for PUT/PATCH allow partial but if present must be valid
        return [
            'name'  => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|numeric|min:0.01',
            'stock' => 'sometimes|required|integer|min:0',
        ];
    }
}
