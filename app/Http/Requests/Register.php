<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Register extends FormRequest
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
            'email' => 'required|string|unique:users',
            'name' => 'required|',
            'password' => 'required|min:6'
        ];
    }
    public function messages()
    {
        return [
          'email.required' => 'Vui lòng ko để trống email',
          'email.unique' => 'Email đã tồn tại',
          'name.required' => 'Vui lòng ko để trống name',
          'password.required' => 'Vui lòng ko để trống password',
          'password.min' => 'Password phải tối thiểu 6 ký tự'
        ];
    }
}
