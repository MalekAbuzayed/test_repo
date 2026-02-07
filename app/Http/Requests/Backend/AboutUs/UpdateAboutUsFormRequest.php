<?php

namespace App\Http\Requests\Backend\AboutUs;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAboutUsFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
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
        'title_ar' => 'required|string|max:255',
        'title_en' => 'required|string|max:255',
        'subtitle_ar' => 'nullable|string|max:255',
        'subtitle_en' => 'nullable|string|max:255',
        'description_ar' => 'required|string',
        'description_en' => 'required|string',
        'bold_description_ar' => 'nullable|string',
        'bold_description_en' => 'nullable|string',
        'icon' => 'nullable|string|max:100', 
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ];
}
}
