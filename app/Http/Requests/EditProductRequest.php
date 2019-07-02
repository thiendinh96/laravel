<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProductRequest extends FormRequest
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
            'code'=>'required|max:10',
            'name'=>'required',
            'price'=>'required|numeric',
            
            'img'=>'image',
        ];
    }
    //messages là function mặc dịnh k đổi tên dc
    public function messages()
    {
        return[
          'code.required'=>'không được để trống mã sản phẩm',
          'code.max'=>'mã sản phâm không quá 10 kí tự',
          'name.required'=>'không được để trống tên sản phẩm',
          'price.required'=>'không được để trống giá sản phẩm',
          'price.numeric'=>'Giá sản phẩm phải là dạng số',
         
          'img.image'=>'Ảnh Không đúng định dạng',
        ];
    }
}
