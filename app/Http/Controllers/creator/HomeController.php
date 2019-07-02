<?php

namespace App\Http\Controllers\creator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\{product,category};

class HomeController extends Controller
{
    function GetIndex(){
        $data['prd_new']=product::orderby('id','desc')->take(8)->get();
        $data['prd_nb']=product::where('featured',1)->take(4)->get();
        return view('creator.index',$data);
    }
    function GetAbout(){
        return view('creator.about');
    }
    function GetContact(){
        return view('creator.contact');
    }
    function GetPrdCate($slug_cate){
        $data['products']=category::where('slug',$slug_cate)->first()->prd()->paginate(6);
        $data['categorys']=category::all();
        return view('creator.product.shop',$data);
    }
    function GetFilter( Request $r){
       
        $data['products']=product::wherebetween('price',[$r->start,$r->end])->paginate(6);
        $data['categorys']=category::all();
        return view('creator.product.shop',$data);
    }
}
