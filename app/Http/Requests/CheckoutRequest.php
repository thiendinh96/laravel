<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'full'=>'required',
            'address'=>'required',
            'phone'=>'required',
 
        ];
    }
    public function messages()
    {
        return [
            'email.required'=>'Không được để trống email',
           'email.email'=>'Email phải đúng định dạng',
           'full.required'=> 'Họ và tên k đc để trống', 
           'address.required'=>'Địa chỉ k đc để trống',
           'phone.required'=>'Số đt k đc để trống',
 
        ];
    }
}
