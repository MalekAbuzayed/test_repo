<?php

namespace App\Http\Requests\Backend\OurGoal;

use Illuminate\Foundation\Http\FormRequest;

class StoreOurGoalFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'icon' => 'required|string|max:100',
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'order' => 'nullable|integer',
        ];
    }

    public function messages()
    {
        return [
            'icon.required' => 'الأيقونة مطلوبة',
            'title_ar.required' => 'العنوان العربي مطلوب',
            'title_en.required' => 'العنوان الإنجليزي مطلوب',
            'description_ar.required' => 'الوصف العربي مطلوب',
            'description_en.required' => 'الوصف الإنجليزي مطلوب',
        ];
    }
}
