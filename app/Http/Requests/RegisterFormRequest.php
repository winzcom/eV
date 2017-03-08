<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
 use Illuminate\Support\Facades\Auth;
 use Illuminate\Validation\Rule;
 use App\Interfaces\RequestInterface;


class RegisterFormRequest extends FormRequest implements RequestInterface
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
        $user = Auth::user();

        $rules = [
            'name' => 'required|max:255',
            'password' => 'required|min:6',
            'password_confirm'=>'required|min:6|same:password',
            'phone_no'=>'required|numeric',
            'house_no'=>'required',
            'street_name'=>'required',
            'state'=>'required',
            'category'=>'required',
            'description'=>'required',
            'first_name'=>'required',
            'last_name'=>'required'
        ];

        


        if($user !== null) {
            $rules  = array_merge($rules,array('email' => array('required','email','max:255',Rule::unique('companies')->ignore($user->id))));
        
        }
        return $rules;
    }
}
