<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SavePostRequest extends FormRequest
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
            'receiver_id' => 'required|numeric',
            'message' => 'required|max:255',
        ];
    }
    /**
     * @return array|string[]
     */
    public function  attributes()
    {
        return [
            'receiver_id' => 'Receiver ID',
            'message' => 'Message',
        ];
    }

    /**
     * @return array|string[]
     */
    public function messages()
    {
        return [
            'receiver_id.required' => ':attribute is required',
            'receiver_id.numeric' => ':attribute is numeric',
            'message.required' => ':attribute is required',
            'message.max:255' => ':attribute must have <= 255',
        ];
    }
}
