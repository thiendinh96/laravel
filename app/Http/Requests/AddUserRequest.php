<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUserRequest extends FormRequest
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
            'email'=>'required|email',
            'password'=>'required|min:5',
            'full'=>'required|min:6',
            'address'=>'required',
            'phone'=>'required',
 
        ];
    }
    public function messages()
    {
        return [
            'email.required'=>'Không được để trống email',
           'email.email'=>'Email phải đúng định dạng',
           'password.required'=>'mật khẩu k đc để trống',
           'password.min'=>'mật khẩu k đc nhỏ hơn 5 kí tự',
           'full.required'=>'Họ tên không được để trống',
           'full.min'=>'Họ tên k đc nhỏ hơn 6 kí tự',
           'address.required'=>'Địa chỉ k đc để trống',
           'phone'=>'Số đt k đc để trống',
 
        ];
    }
}
