<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequestPostRequest extends FormRequest
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
            'id'=>'unique',
            'description'=>'required|regex:/^[a-zA-Z ]+$/', 
            'open_date'=>'required|date',  
            'quantity'=>'required|alpha_num',
            'colored'=>'required',
            'stapled'=>'required',
            'paper_size'=>'required',
            'paper_type'=>'required',
            'file'=>'required',
            
        ];
    }
}
