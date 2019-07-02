<?php

namespace App\Http\Controllers\admin;
//Gọi form request để sử dụng
use App\Http\Requests\{AddproductRequest,EditProductRequest};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\{product,category};

class ProductController extends Controller
{
    function GetAddproduct(){
        $data['category']=category::all()->toarray();
        return view('admin.product.addproduct',$data);
    }
    function PostAddproduct(AddProductRequest $r){ 
       
        $prd = new product;  
        
        $prd->code=$r->code;
        $prd->name=$r->name;
        $prd->slug=str_slug($r->name);
        $prd->price=$r->price;
        $prd->featured=$r->featured;
        $prd->state=$r->state;
        $prd->info=$r->info;
        $prd->describe=$r->describe;
        //Kiểm tra xem người dùng có chọn file upload hay không
        if($r->hasFile('img'))
        {
            //Lấy đường dẫn tạm thời của file ảnh upload
            $file=$r->img;
            //Lấy lên file ảnh upload để lưu vào csdl và trên serve
            $file_name=str_slug($r->name).'.'.$file->getClientOriginalExtension();
            //upload file lên serve
            $file->move('admins/img',$file_name);
            //lưu tên ảnh trong database
            $prd->img =$file_name;
        }
        else {
            $prd->img='no-img.jpg';
        }
        $prd->category_id=$r->category;
        $prd->save();
        return redirect('admin/product')->with('thongbao', 'Đã thêm Thành công');
        
    }
    
    function GetEditproduct($prd_id){
      
     $data['prd']=product::find($prd_id);
     $data['categorys']=category::all()->toarray();

        return view('admin.product.editproduct',$data);
    }

    function PostEditproduct(EditProductRequest $r,$prd_id)
    {
        $prd = product::find($prd_id);  
        
        $prd->code=$r->code;
        $prd->name=$r->name;
        $prd->slug=str_slug($r->name);
        $prd->price=$r->price;
        $prd->featured=$r->featured;
        $prd->state=$r->state;
        $prd->info=$r->info;
        $prd->describe=$r->describe;
        //Kiểm tra xem người dùng có chọn file upload hay không
        if($r->hasFile('img'))
        {
            if($prd->img!='no-img.jpg'){
                unlink('backend/img/'.$prd->img);
            }
            //Lấy đường dẫn tạm thời của file ảnh upload
            $file=$r->img;
            //Lấy lên file ảnh upload để lưu vào csdl và trên serve
            $file_name=str_slug($r->name).'.'.$file->getClientOriginalExtension();
            //upload file lên serve
            $file->move('admins/img',$file_name);
            //lưu tên ảnh trong database
            $prd->img =$file_name;
        }
        
        $prd->category_id=$r->category;
        $prd->save();
         return redirect()->back()->with('thongbao',"Đã sửa thành công");
    }

    function GetListproduct(){
        //phân trang: trong 1 trang chứa 3 sản phẩm
        $data['products']=product::paginate(3);
        return view('admin.product.listproduct',$data);
    }
    function GetDelproduct($prd_id)
    {
       product::destroy($prd_id);
        return redirect()->back()->with('thongbao',"Đã xóa thành công");
    }
} 
