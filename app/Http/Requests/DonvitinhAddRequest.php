<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class DonvitinhAddRequest extends Request
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
            'txtDVTName'    => 'required|unique:donvitinh,donvitinh_ten'
        ];
    }

    public function messages() {
        return [
            'txtDVTName.required'   => '<div><strong  style="color: red;">Vui lòng không để trống trường này!</strong></div>',
            'txtDVTName.unique'     => '<div><strong  style="color: red;">Dữ liệu này đã tồn tại!</strong></div>'
        ];
    }
}
