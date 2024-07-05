<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\OrderController;
use App\Models\OrderItems;

class StoreController extends Controller
{
    public function cart(){
        return view('frontend.cart');
    }

    public function addToCart($id){
        $product = Product::find($id);
        $cart = session()->get('cart', []);

        if(isset($cart[$id])){
            $cart[$id]['quantity']++;
        }else{
            $cart[$id] = [
                "product_id" => $product->id,
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully...!');
    }

    public function checkout()
    {
        $cart = session()->get('cart');

        $totalAmount = 0;

        foreach ($cart as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
        }

        $order = new Order();
        //$order->user_id = Auth::user()->id;
        $order->user_id = 1;
        $order->amount = $totalAmount;
        $order->save();

        $data = [];

        foreach ($cart as $item) {
            //dd($item);
            $data['items'] = [
                [
                    'product_id' => $item['product_id'],
                    'name' => $item['name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                ]
            ];

            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item['product_id'];
            $orderItem->quantity = $item['quantity'];
            $orderItem->amount = $item['price'];
            $orderItem->save();
        }

        $data['invoice_id'] = $order->id;
        $data['invoice_description'] = "Your Order #{$order->id}";
        $data['total'] = $totalAmount;
        
        session()->put('cart', []);
        Session::flash('checkout_success', 'Payment successful!');
        return back();
    }

    public function clearCart()
    {
        $cart = session()->get('cart');
        foreach($cart as $key =>$value){
            unset($cart[$key]);
        }
        session()->put('cart', $cart);
        Session::flash('success', 'Clearing all cart successfully!');
        return back(); 
    }
}

    

