<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class signupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules()
    {
        return [
            'name'=>'required',
            'age'=>'required|numeric',
            'phone'=>'required|numeric',
            'web'=>'required',
            'address'=>'string'

        ];
    }
    public function messages()
    {
        return [
            'name.required' =>'Tên không được để trống',
            'age.required' =>'Tuổi không được để trống',
            'age.numeric'=>'Tuổi chỉ nhập số nguyên',
            'phone.required'=>'Số điện thoại không được để trống',
            'phone.numeric'=>'Vui lòng nhập đúng định dạng số điện thoại',
            'web.required'=>'Vui lòng nhập link trang web',
            'address.string'=>'Vui lòng nhập lại địa chỉ của bạn'
        ];
    }
}
