<?php

namespace App\Http\Controllers\admin;
use App\Http\Requests\{AddUserRequest,EditUserRequest};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\user;

class UserController extends Controller
{
    function GetAddUser(){
        return view('admin.user.adduser');
    }
    function PostAddUser(AddUserRequest $r){
        $user = new user;
        $user->email=$r->email;
        $user->password=bcrypt($r->password);
        $user->full=$r->full;
        $user->address=$r->address;
        $user->phone=$r->phone;
        $user->level=$r->level;
        $user->save();

        return redirect('admin/user')->with('thongbao',"Đã thêm thành công");
    }
    function GetEdituser($id_user){
        $data['user']=user::find($id_user);
        return view('admin.user.edituser',$data);
    }   
    function PostEditUser(EditUserRequest $r,$id_user){
        $user=user::find($id_user);
        $user->email=$r->email;
        if ($r->password!="") {
            $user->password=bcrypt($r->password);
       }
        $user->full=$r->full;
        $user->address=$r->address;
        $user->phone=$r->phone;
        $user->level=$r->level;
        $user->save();

        return redirect()->back()->with('thongbao','Đã sửa thành công');
    }

    function GetListuser(){
        $data['users']=user::paginate(7);
        return view('admin.user.listuser',$data);
    }
    function DelUser($id_user){
        user::destroy($id_user);
        return redirect()->back()->with('thongbao','Đã xóa thành công');
    }
}
