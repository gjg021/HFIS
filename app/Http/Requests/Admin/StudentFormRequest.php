<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StudentFormRequest extends FormRequest{

    
    public function authorize(){

        return true;
    }

   
    public function rules(){

        return [

            'first_name' => 'required|string|max:45',
            'last_name' => 'required|string|max:45',
            'middle_name' => 'required|string|max:45',
            'birthday' => 'required|date',
            'region' => 'required|string|max:45',
            'province' => 'required|string|max:45',
            'municipality' => 'required|string|max:45',
            'barangay' => 'required|string|max:45',
            'address' => 'required|string|max:255',
            'sy' => 'required|int',
            // 'username'=>'sometimes|required|string|max:45|unique:admins,username,'.$this->route('user').',slug',
            // 'password'=>'sometimes|required|string|min:6|max:45|confirmed|same:password_confirmation',
            // 'password_confirmation'=>'sometimes|required|string|min:6|max:45',
            'email'=>'required|string|email|max:45',
            //'phone'=>'required|string|phone|max:45',

        ];

    }




}