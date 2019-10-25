<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePassword extends FormRequest
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
            'new_password' => 'required|min:6|max:20|confirmed',
            'new_password_confirmation' => 'required|min:6|max:20'
        ];
    }
    public function messages()
    {
        return [
          'new_password.confirmed' => 'Mật khẩu mới không trùng khớp'
        ];
    }
}
