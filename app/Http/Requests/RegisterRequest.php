<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required!',
            'email.required' => 'Email is required',
            'email.email'  => 'Invalid email',
            'email.unique' => 'Email is already taken',
            'password.required' => 'Password is required',
            'password.confirmed' => 'Password does not matched',
            'password.min' => 'Password minimum length is 6'
        ];
        
    }
}
