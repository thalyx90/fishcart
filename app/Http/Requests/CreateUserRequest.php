<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateUserRequest extends Request
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
            'username'=>'required|unique:users',
            'email'=>'required',
            'password'=>'required|confirmed',
            'firstname'=>'required',
            'lastname'=>'required'

        ];
    }

    public function messages()
    {
        return [
            'username.required'=>'Hey ya- fill it out',
            

        ];
    }
}
