<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SingleServiceRequest extends FormRequest
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
        return [
            'name' => [
                // 'sometimes',  // required only when name has been changed
                'required',
                Rule::unique('service_translations', 'name')->ignore($this->id),
            ],
            'price' => 'required|numeric'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => trans('validation.required'),
            'name.unique' => trans('validation.unique'),
            'price.required' => trans('validation.required'),
            'price.unique' => trans('validation.numeric'),
        ];
    }
}
