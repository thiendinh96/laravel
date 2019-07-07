<?php

namespace App\Http\Controllers\creator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\{product,category};

class ProductController extends Controller
{
    function GetDetail($slug_prd){
        $data['prd']=product::where("slug",$slug_prd)->first();
        $data['prd_new']=product::orderby('id','desc')->take(4)->get();
        return view('creator.product.detail',$data);
    }
    
    function GetShop(){
        $data['products']=product::paginate(6);
        $data['categorys']=category::all();
        return view('creator.product.shop',$data);
    }
}
