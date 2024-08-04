<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class indexController extends Controller
{
    public function index(){
        $orders = Order::OrderBy('id','DESC')->get();
        return view('seller.index',compact('orders'));
}
}
