<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployee extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
                     'company' => ['required'],
                    'first_name' => ['required','string', 'max:255'],
                    'last_name' => ['required','string', 'max:255'],
                    'mobile' => ['required','numeric', 'digits:10'],

                 ]; 
        if ($this->email) {
            $rules = $rules + [ 'email' => 'required|email|max:255'];
        }
          return $rules;
    }
}
