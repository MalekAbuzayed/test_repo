<?php

namespace App\Http\Requests\Backend\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;


class UpdateUserFormRequest extends FormRequest
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
            'first_name' => 'required|string|max:190',
            'last_name' => 'required|string|max:190',
            'email' => 'required|email|unique:users,email,' . $this->id,
            'phone' => 'required|min:7|unique:users,phone,' . $this->id,
            'password' => ['nullable', Password::min(8)->mixedCase()->numbers()->symbols(), 'confirmed'],
            'password_confirmation' => 'same:password',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'first_name.required' => 'First name required',
            'last_name.required' => 'New name required',

            'email.required' => 'Email required',
            'email.email' => 'Email should be correct',
            'email.unique' => 'Email already in use',

            'phone.required' => 'required phone number',
            'phone.min' => 'The phone number must contain 7 digits for the amount',
            'phone.digits' => 'The phone number must consist of 7 digits in the amount',
            'phone.numeric' => 'Phone number must be a number',
            'phone.unique' => 'The phone number entered used',

            'password.required' => 'required password',
            'password.min' => 'The password must not exceed 8 characters and contain a symbol and a large degree',
            'password.confirmed' => 'Password must match',
            'password_confirmation.confirmed' => 'Password must match',
            'password_confirmation.required' => 'Password matching required',
            'password_confirmation.min' => 'Must match',

        ];
    }
}
