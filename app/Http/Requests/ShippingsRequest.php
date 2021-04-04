<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShippingsRequest extends FormRequest
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
            'id' => 'required|exists:settings',
            'value' => 'required|string',
            'plain_value' => 'nullable|numeric',
        ];
    }

    public function messages()
    {
        if (app() ->getLocale() === 'ar') {
            return [
                'id.required' =>   'يجب ادخال هذا الحقل' ,
                'value.required' => 'يجب ادخال الحقل ',
                'plain_value.required' => 'يجب ادخال الحقل ',
                'plain_value.numeric' => 'يجب ادخال هذا الحقل أرفام',
                'value.string' => 'يجب ادخال هذا الحقل حروف'
            ];
        }
       return [
           'id.required' =>   'this field is required' ,
           'value.required' => 'this field is required ',
           'plain_value.required' => 'this field is required',
           'plain_value.numeric' => 'this field is must be number',
           'value.string' => 'this field is must be string'
       ];

    }
}
