<?php

namespace App\Http\Controllers\creator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\{product,category};

class ProductController extends Controller
{
    function GetDetail(){
        return view('creator.product.detail');
    }
    
    function GetShop(){
        $data['products']=product::paginate(6);
        $data['categorys']=category::all();
        return view('creator.product.shop',$data);
    }
}
