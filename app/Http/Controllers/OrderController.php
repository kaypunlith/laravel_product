<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    
    public function index(){
        $orders = Order::all();

        return view('order.index', compact('orders'));

    }
    public function approve($id){
        $orders = Order::find($id);
        $orders->status = 1;
        $orders->save();
        return redirect()->back();

    }
    public function reject($id){
        $orders = Order::find($id);
        $orders->status = 0;
        $orders->save();
        return redirect()->back();

    }
}
