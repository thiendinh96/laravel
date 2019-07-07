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
            'code'=>'required|max:10|unique:product,code,'.$this->prd_id.',id',
            'name'=>'required|min:3|unique:product,name,'.$this->prd_id.',id',
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
          'code.unique'=>'Mã sản phẩm đã tồn tại',
          'name.required'=>'không được để trống tên sản phẩm',
          'name.min'=>'Tên sản phẩm lớn hơn 3 kí tự',
          'name.unique'=>'Tên sản phẩm đã tồn tại',
          'price.required'=>'không được để trống giá sản phẩm',
          'price.numeric'=>'Giá sản phẩm phải là dạng số',
         
          'img.image'=>'Ảnh Không đúng định dạng',
        ];
    }
}
