<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveProfileRequest extends FormRequest
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
            'name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'dob' => 'required|date',
            'location' => 'required|max:50',
            'phone' => 'required|numeric',
        ];
    }

    /**
     * @return array|string[]
     */
    public function  attributes()
    {
        return [
            'name' => 'Field Name',
            'last_name' => 'Field Last Name',
            'dob' => 'Field Date of birth',
            'location' => 'Field Location',
            'phone' => 'Field Phone',
        ];
    }

    /**
     * @return array|string[]
     */
    public function messages()
    {
        return [
            'name.required' => ':attribute is required',
            'name.max:50' => ':attribute must have <= 50',
            'last_name.required' => ':attribute is required',
            'last_name.max:50' => ':attribute must have <= 50',
            'dob.required' => ':attribute is required',
            'dob.date' => ':attribute typeof must be date',
            'location.required' => ':attribute is required',
            'location.max:50' => ':attribute must have <= 50',
            'phone.required' => ':attribute is required',
            'phone.numeric' => ':attribute must be numeric',
        ];
    }

}
