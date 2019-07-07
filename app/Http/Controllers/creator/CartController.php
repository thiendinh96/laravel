<?php

namespace App\Http\Controllers\creator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\product;
use Cart;

class CartController extends Controller
{
    function GetCart() {
        
        $data['cart']=Cart::content();
        $data['total']=Cart::total(0,"",".");
        return view('creator.cart.cart',$data);
    }
    function AddCart(request $r)
    {
        $prd=product::find($r->id_prd);
        if ($r->has('qty')) {
            $qty=$r->qty;
        } else {
            $qty=1;
        }
        
        Cart::add([
            'id' => $prd->code,
            'name' => $prd->name,
            'qty' => $qty,
            'price' => $prd->price,
            'weight' => 0,
            'options' => ['img' => $prd->img]]);

        return redirect('cart');
    }
    function UpdateCart($rowID,$qty){
        Cart::update($rowID,$qty);
        return "success";
    }
    function DelCart($rowId){
        Cart::remove($rowId);
        return redirect()->back();
    }
}
