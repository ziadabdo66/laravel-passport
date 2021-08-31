<?php

namespace App\Http\Requests;

use App\Rules\editValidate;
use Illuminate\Foundation\Http\FormRequest;

class userRequest extends FormRequest
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
            "email"=>['required','email',$this->Editemail($this->email,$this->user_id)],
            "password"=>"required",
            "username"=>'required',
            "city"=>'required',
            "photo"=>"required"

        ];
    }
    public function Editemail($email,$user_id){

    }
}
