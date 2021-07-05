<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NhanvienEditRequest extends FormRequest
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
            'txtNVName' =>'required',
            'txtNVID'   =>'required',
            'txtNVPhone'=>'required|size:10',
            'txtNVDate' =>'required',
            'txtNVAddress'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'required'=> '<div><strong  style="color: red;">Vui lòng không để trống trường này!</strong></div>',
            'txtNVPhone.size'=>'<div><strong  style="color: red;">Số điện thoại có độ dài là 10!</strong></div>'
        ];
    }
}
