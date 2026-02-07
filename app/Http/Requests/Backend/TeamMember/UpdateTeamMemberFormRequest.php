<?php

namespace App\Http\Requests\Backend\TeamMember;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeamMemberFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'position_ar' => 'required|string|max:255',
            'position_en' => 'required|string|max:255',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer',
        ];
    }

    public function messages()
    {
        return [
            'name_ar.required' => 'الاسم العربي مطلوب',
            'name_en.required' => 'الاسم الإنجليزي مطلوب',
            'position_ar.required' => 'المسمى الوظيفي العربي مطلوب',
            'position_en.required' => 'المسمى الوظيفي الإنجليزي مطلوب',
            'description_ar.required' => 'الوصف العربي مطلوب',
            'description_en.required' => 'الوصف الإنجليزي مطلوب',
            'image.image' => 'الملف يجب أن يكون صورة',
            'image.mimes' => 'صيغة الصورة يجب أن تكون: jpeg, png, jpg, gif',
            'image.max' => 'حجم الصورة يجب ألا يتعدى 2MB',
        ];
    }
}
