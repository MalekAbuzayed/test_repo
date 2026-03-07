<?php

namespace App\Http\Requests\Backend\Product;

use App\Models\Grandchild;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class UpdateProductFormRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:1,2'],
            'subcategory_id' => ['required', 'exists:subcategories,id'],
            'grandchild_id' => ['nullable', 'exists:grandchilds,id'],

            // images (2MB)
            'images' => ['nullable', 'array'],
            'images.*' => ['file', 'mimes:jpg,jpeg,png,webp,gif', 'max:2048'],

            // typed files
            'files' => ['nullable', 'array'],
            'files.*' => ['nullable', 'array'],

            // 5MB documents
            'files.datasheet.*' => ['file', 'mimes:pdf,doc,docx,xls,xlsx,zip,rar,txt', 'max:5120'],
            'files.certificate.*' => ['file', 'mimes:pdf,doc,docx,xls,xlsx,zip,rar,txt', 'max:5120'],
            'files.manual.*' => ['file', 'mimes:pdf,doc,docx,xls,xlsx,zip,rar,txt', 'max:5120'],
            'files.guide.*' => ['file', 'mimes:pdf,doc,docx,xls,xlsx,zip,rar,txt', 'max:5120'],
            'files.ond.*' => ['file', 'mimes:pdf,doc,docx,xls,xlsx,zip,rar,txt', 'max:5120'],

            // videos (200MB)
            'files.install_video.*' => ['file', 'mimes:mp4,mov,avi,webm,mkv', 'max:204800'],

            // specs
            'spec_values' => ['nullable', 'array'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'subcategory_id.required' => 'The product type field is required.',
            'grandchild_id.required' => 'The grandchild field is required.',
            'grandchild_id.exists' => 'The selected grandchild is invalid.',
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            $subcategoryId = $this->input('subcategory_id');
            $grandchildId = $this->input('grandchild_id');

            if (!$subcategoryId) {
                return;
            }

            $subcategoryHasGrandchilds = Grandchild::query()
                ->where('subcategory_id', $subcategoryId)
                ->exists();

            if ($subcategoryHasGrandchilds && !$grandchildId) {
                $validator->errors()->add('grandchild_id', 'The grandchild field is required for the selected subcategory.');
                return;
            }

            if (!$grandchildId) {
                return;
            }

            $belongsToSubcategory = Grandchild::query()
                ->where('id', $grandchildId)
                ->where('subcategory_id', $subcategoryId)
                ->exists();

            if (!$belongsToSubcategory) {
                $validator->errors()->add('grandchild_id', 'The selected grandchild must belong to the selected subcategory.');
            }
        });
    }
}
