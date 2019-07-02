<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    //Mặc định khi thêm vào bảng Sẽ tự động thêm dữ liệu cho 2 cột created_at,updated_at
    // liên kết đến bảng xác định
    protected $table="category";
    //khai báo khoá chính (Chữ K viết hoa)
    // protected $primaryKey = 'id';

    //Khai báo không sử dụng timestamps
    public $timestamps=false;

    // Liên kết 1-n chiều thuận
    public function prd()
    {
        return $this->hasMany('App\models\product','category_id','id');
    }


}
