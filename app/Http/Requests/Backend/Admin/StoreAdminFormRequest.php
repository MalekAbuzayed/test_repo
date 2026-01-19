<?php

namespace App\Http\Requests\Backend\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;


class StoreAdminFormRequest extends FormRequest
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
        // dd($this->all());

        return [
            'name' => 'required',
            'email' => 'required|email|unique:admins,email',
            'password' => ['required', Password::min(8)->mixedCase()->numbers()->symbols(), 'confirmed'],
            'password_confirmation' => 'required|same:password',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => ' Name is Required',

            // email
            'email.required' => 'Email is required',
            'email.email' => 'Email Must be valid',
            'email.unique' => 'Email is already used use another',

            // password
            'password.required' => 'Password Is Required',
            'password.min' => 'Password must be at least 8 digits',
            'password.confirmed' => 'Password must be confirmed',
            'password_confirmation.confirmed' => 'Password must match',
            'password_confirmation.required' => 'Confirmation Password must match',
            'password_confirmation.min' => 'Confirmation Password must match',

        ];
    }
}
