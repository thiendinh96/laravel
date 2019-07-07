<?php

namespace App\Http\Controllers\admin;
use App\Http\Requests\AddCategoryRequest;
use App\Http\Requests\EditCategoryRequest; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\category;
class CategoryController extends Controller
{
    function GetCategory()
    {
        // model thì thường dùng phương thức all() thay thế Get() 
        //để lấy ra toàn bộ dữ liệu trong bảng
        $data['categorys']=category::all()->toarray();
        return view('admin.category.category',$data);
    }

    function PostCategory(AddCategoryRequest $r)
    {
        $name=$r->name;
        $parent=$r->parent;
        $cate=new category;
        $cate->name=$name;
        $cate->slug=str_slug($name);
        $cate->parent=$parent;
        $cate->save();
        return redirect()->back()->with('thongbao','Đã Thêm Danh Mục Thành Công');
    }

    
    function GetEditCategory($cate_id)
    {
      $data['cate']=category::find($cate_id);
      $data['categorys']=category::all()->toarray();
       return view('admin.category.editcategory',$data);
    }
    function PostEditCategory(EditCategoryRequest $r,$cate_id){
        $name=$r->name;
        $parent=$r->parent;
        $cate=category::find($cate_id);
        $cate->name=$name;
        $cate->slug=str_slug($name);
        $cate->parent=$parent;
        $cate->save();
        return redirect()->back()->with('thongbao', 'Đã Sử Danh Mục Thành Công');
    }

    function DelCategory($cate_id)
    {
        $cate=category::find($cate_id);
        category::where('parent',$cate_id)->update(['parent'=>$cate->parent]);
        category::destroy($cate_id);
        return redirect()->back()->with('thongbao','Đã xóa thành công');
    }
}
