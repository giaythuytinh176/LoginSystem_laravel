<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
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
        return [//logins is table to check unique
            'username' => 'required|unique:users|min:2|max:50',
            'email' => 'required|unique:users|email|min:2|max:50',
            'name' => 'required|string|min:2|max:50',
            'password' => 'required|string|confirmed|min:6|max:100',
            'password_confirmation' => 'required|min:6|max:100',
        ];
    }
}
