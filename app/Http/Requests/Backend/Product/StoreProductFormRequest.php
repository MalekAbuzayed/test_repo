<?php

namespace App\Http\Requests\Backend\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductFormRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'type' => 'required|in:other,batteries,hybrid,onGrid,pv-module',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,zip,rar,txt|max:5120',
            'status' => 'required|in:1,2',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The product name field is required.',
            'name.max' => 'The product name may not be greater than 255 characters.',
            'type.required' => 'The product type field is required.',
            'type.in' => 'The selected product type is invalid.',
            'title.required' => 'The product title field is required.',
            'title.max' => 'The product title may not be greater than 255 characters.',
            'description.required' => 'The product description field is required.',
            'image.image' => 'The image must be a valid image file.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, svg, webp.',
            'image.max' => 'The image may not be greater than 2MB.',
            'file.mimes' => 'The file must be a file of type: pdf, doc, docx, xls, xlsx, zip, rar, txt.',
            'file.max' => 'The file may not be greater than 5MB.',
            'status.required' => 'The status field is required.',
            'status.in' => 'The selected status is invalid.',
        ];
    }
}
