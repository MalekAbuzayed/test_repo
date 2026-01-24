<?php

namespace App\Http\Requests\Backend\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreUserFormRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|min:7|numeric|unique:users,phone',
            'password' => ['required', Password::min(8)->mixedCase()->numbers()->symbols(), 'confirmed'],
            'password_confirmation' => 'required|same:password',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'First Name is Required',
            'last_name.required' => 'Last Name is Required',

            // email
            'email.required' => 'Email is required',
            'email.email' => 'Email Must be valid',
            'email.unique' => 'Email is already used use another',

            // phone
            'phone.required' => 'Phone is required',
            'phone.numeric' => 'phone must be numeric',
            'phone.unique' => 'phone number is already used try another',

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
