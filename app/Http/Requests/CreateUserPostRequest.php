<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserPostRequest extends FormRequest
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
                'name' => 'required|regex:/^[a-zA-Z ]+$/',
                'email' => 'required|email|unique:users',
                'phone' => 'required|numeric|size:9',
                'department_id' => 'required|exists:departments,id',
                'profile_url' => 'regex:/^((http[s]?|ftp):\/)?\/?([^:\/\s]+)((\/\w+)*\/)([\w\-\.]+[^#?\s]+)(.*)?(#[\w\-]+)?$/',
                'presentation' => 'regex:/^[a-zA-Z ]+$/'
        ];
    }
}
