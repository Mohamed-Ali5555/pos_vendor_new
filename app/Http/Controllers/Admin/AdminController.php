<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class AdminController extends Controller
{
    public function index(){
        $orders = Order::OrderBy('id','DESC')->get();
        return view('admin.index',compact('orders'));
    }
}

