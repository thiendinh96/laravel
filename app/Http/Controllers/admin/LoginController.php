<?php

namespace App\Http\Controllers\admin;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    function GetLogin(){
        return view('admin.login.login');
    }
    function PostLogin(Loginrequest $r){
       // mảng các quy tắc cho dữ liệu ô input
       //key: name của ô input
       //value: các quy tắc ô input cần tuân thủ
      
       $email =$r->email;
       $password =$r->password;
       if($r->has('remember')){
           $rem=true;
       }
       else{
           $rem=false;
       }
       if(Auth::attempt(['email' => $email, 'password' => $password], $rem))
       {
            return redirect('admin');
       }
       else {
            return redirect()->back()->withInput()->with('error','Tài khoản hoặc mật khẩu sai!');
       }
    }
}    