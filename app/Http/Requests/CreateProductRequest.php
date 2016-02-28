<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateProductRequest extends Request
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
   public function rules()
    {
        return [
            'name'=>'required',
            'description'=>'required',
            'price'=>'required',
            'photo'=>'required',
            'type_id'=>'required'
        ];
    }
    
    public function messages()
    {
        return [
            'name.required'=>'Empty',
            'description.required'=>'Empty',
            'price.required'=>'Empty',
            'photo.required'=>'Empty',
            'type_id.required'=>'Empty'

            
        ];
    }
}
