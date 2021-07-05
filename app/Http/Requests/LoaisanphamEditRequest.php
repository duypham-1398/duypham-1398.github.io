<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LoaisanphamEditRequest extends Request
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
            'txtLSPName'    => 'required',
            'txtLSPParent'  => 'required',
            'fImage' => 'mimes:jpeg,bmp,png|max:4000'
        ];
    }

    public function messages() {
        return [
            'txtLSPName.required'   => '<div><strong  style="color: red;">Vui lòng không để trống trường này!</strong></div>',
            'txtLSPParent.required'   => '<div><strong  style="color: red;">Vui lòng chọn dữ liệu!</strong></div>',
            'mimes' => '<div><strong  style="color: red;">Vui lòng chọn đúng file ảnh</strong></div>',
            'fImage.max' => '<div><strong  style="color: red;">Vui lòng chọn file ảnh có kích thước không quá 2MB</strong></div>'
        ];
    }
}