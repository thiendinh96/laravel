<?php

namespace App\Http\Controllers\creator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cart;
use App\models\{order,product_order};
use App\http\Requests\CheckOutRequest;
class CheckOutController extends Controller
{
    function GetCheckout() {
        $data['cart']=Cart::content();
        $data['total']=Cart::total(0,"",".");
        return view('creator.checkout.checkout',$data);
    }
    function PostCheckout(CheckoutRequest $r)
    {
       
        $order = new order;
        $order->full= $r->full;
        $order->address=$r->address;
        $order->email=$r->email;
        $order->phone=$r->phone;
        $order->total=cart::total(0,"",""); 
        $order->state=2;
        $order->save();

        foreach (Cart::content() as $row) {
           $prd = new product_order; 
           $prd->code = $row->id;
           $prd->name = $row->name;
           $prd->price = round($row->price,0);
           $prd->quantity = $row->qty;
           $prd->img = $row->options->img;
           $prd->order_id = $order->id;
           $prd->save();
        }

        // Xóa toàn bộ giỏ hàng
        Cart::destroy();    
        return redirect('checkout/complete/'.$order->id);


    }
    function GetComplete($order_id){
        $data['order']=order::find($order_id);
        return view('creator.checkout.complete',$data);
    }
}
