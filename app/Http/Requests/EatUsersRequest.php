<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EatUsersRequest extends FormRequest
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
            'eaten' => "required|array",
            'eaten.*' => "not_in:{$this->user()->id}",
        ];
    }

    /**
     * @return array|string[]
     */
    public function messages()
    {
        return [
            'eaten.required' => 'Eaten array is required',
            'eaten.array' => 'Eaten must be instanceof Array',
            'eaten.*.not_in' => 'Can not eat yourself',
        ];
    }
}
