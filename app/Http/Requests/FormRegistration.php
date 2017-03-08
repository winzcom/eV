<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Interfaces\RequestInterface;

class FormRegistration extends FormRequest implements RequestInterface
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        
            'password' => 'required|min:6',
            'password_confirm'=>'required|min:6|same:password',
            'phone_no'=>'required|numeric',
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required|email'
        ];
    }
}
