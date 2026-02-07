<?php

namespace App\Http\Requests\Backend\OurVision;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOurVisionFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'icon' => 'nullable|string|max:100',
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'bold_description_ar' => 'required|string',
            'bold_description_en' => 'required|string',
            'normal_description_ar' => 'required|string',
            'normal_description_en' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'title_ar.required' => 'العنوان العربي مطلوب',
            'title_en.required' => 'العنوان الإنجليزي مطلوب',
            'bold_description_ar.required' => 'النص الغامق العربي مطلوب',
            'bold_description_en.required' => 'النص الغامق الإنجليزي مطلوب',
            'normal_description_ar.required' => 'النص العادي العربي مطلوب',
            'normal_description_en.required' => 'النص العادي الإنجليزي مطلوب',
        ];
    }
}
