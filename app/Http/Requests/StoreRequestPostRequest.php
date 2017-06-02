<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'description'=>'required',
            'quantity'=>'required|alpha_num',
            'colored' => [
                'required',
                Rule::in(['0', '1']),
            ],
            'stapled' => [
                'required',
                Rule::in(['0', '1']),
            ],
            'paper_size' => [
                'required',
                Rule::in(['3', '4']),
            ],
            'paper_type' => [
                'required',
                Rule::in(['0', '1', '2']),
            ],
            'front_back' => [
                'required',
                Rule::in(['0', '1']),
            ],
            'file' => 'mimetypes:image/*,application/msword,application/excel,application/excel,application/pdf,application/vnd.oasis.opendocument.text'
        ];
    }
}
