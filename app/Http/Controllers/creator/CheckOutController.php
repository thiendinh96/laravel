<?php

namespace App\Http\Controllers\creator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CheckOutController extends Controller
{
    function GetCheckout() {
        return view('creator.checkout.checkout');
    }
    function GetComplete(){
        return view('creator.checkout.complete');
    }
}
