<?php

namespace App\Http\Requests\Backend\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;


class UpdateAdminFormRequest extends FormRequest
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
            'name' => 'required|string|max:190',
            'email' => 'required|email|unique:admins,email,' . $this->id,
            'password' => ['nullable', Password::min(8)->mixedCase()->numbers()->symbols(), 'confirmed'],
            'password_confirmation' => 'same:password',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'name required',

            'email.required' => 'Email required',
            'email.email' => 'Email should be correct',
            'email.unique' => 'Email already in use',

            'password.required' => 'required password',
            'password.min' => 'The password must not exceed 8 characters and contain a symbol and a large degree',
            'password.confirmed' => 'Password must match',
            'password_confirmation.confirmed' => 'Password must match',
            'password_confirmation.required' => 'Password matching required',
            'password_confirmation.min' => 'Must match',

        ];
    }
}
