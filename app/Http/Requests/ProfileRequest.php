<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,'. $this->id,
            'password' => 'nullable|confirmed|min:8',
        ];
    }

    public function messages()
    {

        if (app()->getLocale() === 'ar') {
            return [
                'email.required' => 'يجب ادخال الايميل',
                'email.email' => 'يجب ادخال الايميل بطريقة صحيحة ',
                'email.unique' => 'هذا الايميل موجود مسبقا',
                'name.required' => 'يجب ادخال هذا الحقل',
                'password.confirmed' => 'يرجي تأكيد هذا الباسورد'
            ];
        }
        return [
            'email.required' => 'this field is required',
            'name.required' => 'this field is required ',
            'email.unique' => 'this field is not unique '
        ];
    }
}
