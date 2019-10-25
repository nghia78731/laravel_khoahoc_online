<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeAvatar extends FormRequest
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
            'image' => 'image|max:2048|required'
        ];
    }
    public function messages()
    {
        return [
          'image.image' => 'Xin vui lòng nhập đúng định dạng hình ảnh',
          'image.max' => 'Hình ảnh giới hạn dung lượng không quá 2M',
          'image.required' => 'Vui lòng chọn hình ảnh'
        ];
    }
}
