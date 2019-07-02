<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\order;
class OrderController extends Controller
{
    function GetOrder(){
        $data['orders']=order::where('state',2)->orderby('id','desc')->paginate(3);
        return view('admin.order.order',$data);
    }
    function GetDetailorder($order_id){
        $data['order']=order::find($order_id);
        return view('admin.order.detailorder',$data);   
    }
    function GetProcessed(){
        $data['order']=order::where('state',1)->orderby('updated_at','desc')->paginate(3);
        return view('admin.order.processed',$data);
    }
    function paid($order_id){
        $order=order::find($order_id);
        $order->state=1;
        $order->save();
        return redirect('admin/order/processed');
    }
}
