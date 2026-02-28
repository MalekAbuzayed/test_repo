<?php

namespace App\Http\Requests\Backend\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // or your auth logic
    }

    public function rules(): array
    {
        return [


            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:1,2'],
            'subcategory_id' => ['required', 'exists:subcategories,id'],

            // images
            'images' => ['nullable', 'array'],
            'images.*' => ['file', 'mimes:jpg,jpeg,png,webp,gif', 'max:2048'],

            // typed files
            'files' => ['nullable', 'array'],
            'files.*' => ['nullable', 'array'],
            'files.*.*' => ['file', 'max:10240'],

            // specs
            'spec_values' => ['nullable', 'array'],
        ];
    }

    public function messages(): array
    {
        return [
            'subcategory_id.required' => 'The product type field is required.',
            'name.required' => 'The product name field is required.',
        ];
    }
}
