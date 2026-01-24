<?php

namespace App\Http\Requests\Backend\Slider;

use Illuminate\Foundation\Http\FormRequest;

class StoreSliderFormRequest extends FormRequest
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
        $rules = [
            'status' => 'required|numeric|integer|in:1,2',
            'type' => 'required|numeric|integer|in:1,2',
            'title_ar' => 'required|string|max:190',
            'title_en' => 'required|string|max:190',
            'description_ar' => 'nullable',
            'description_en' => 'nullable',
        ];

        if ($this->input('type') == 1) {
            $rules['video'] = 'nullable';
            $rules['image'] = 'required|mimes:png,jpg,jpeg,gif|max:5209';
        }

        if ($this->input('type') == 2) {
            $rules['image'] = 'nullable';
            $rules['video'] = 'required|mimes:mp4,webm,ogv,mov,avi,wmv|max:5209';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'title_ar.required' => 'Title AR Is Required',
            'title_en.required' => 'Title EN Is Required',

            'description_ar.required' => 'Description AR Is Required',
            'description_en.required' => 'Description EN Is Required',

            'status.required' => 'Status Is Required',
            'status.integer' => 'Status Must Be Integer',
            'status.numeric' => 'Status Must Be Numeric',
            'status.in' => 'Status Must Be Either Active or Inactive',

            'type.required' => 'Type Is Required',
            'type.integer' => 'Type Must Be Integer',
            'type.numeric' => 'Type Must Be Numeric',
            'type.in' => 'Type Must Be Either Image or Video',

            'image.required' => 'Image Is Required',
            'image.mimes' => 'Image Must be Of Valid Type :png,jpg,jpeg,gif,bmp',
            'image.max' => 'Image  Max Size Can Not Exceed 5MB ',

            'video.required' => 'Image Is Required',
            'video.mimes' => 'Image Must be Of Valid Type :mp4,webm,ogv,mov,avi,wmv',
            'video.max' => 'Image  Max Size Can Not Exceed 5MB ',
        ];
    }
}
