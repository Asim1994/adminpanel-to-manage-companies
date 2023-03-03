<?php

namespace App\Http\Requests;
use App\Models\Company;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCompany extends FormRequest
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
    public function rules(): array
    {
        
       if($this->company_id==null) {

            $rules = [ 'name' => ['required','string', 'max:255','unique:companies'], ]; 

            if ($this->email) {
             $rules = $rules + [ 'email' => 'required|email|max:255'];
            }

        }else{

          $rules = ['name' => ['required','string', 'max:255',Rule::unique(Company::class)->ignore($this->company_id)], ];

          if ($this->email) {
             $rules = $rules + [ 'email' => 'required|email|max:255'];
          }
        }

         if ($this->logo) {
            $rules = $rules + ['logo' => 'required|mimes:jpeg,jpg,png|max:2000|dimensions:min_width=100,min_height=100'];
          }
          if ($this->website) {
            $rules = $rules + ['website' => 'required|url'];
          }

               return $rules;
 

         
    }
}
