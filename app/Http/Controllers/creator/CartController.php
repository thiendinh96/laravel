<?php

namespace App\Http\Controllers\creator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    function GetCart() {
        return view('creator.cart.cart');
    }
}
