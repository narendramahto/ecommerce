<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CouponUsed;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Checkout process
    public function store(Request $request)
    {
        $userId = Auth::user()->id;
        
        if($request->has("coupon_id") && !empty($request->coupon_id))
        {
            $couponUsed=CouponUsed::where('coupon_id',$request->coupon_id)->where('user_id',$userId)->where('status',0)->first();
            $discount_price=$couponUsed!=null?$couponUsed->discount_price:0;
        }
        else{
            $discount_price=0;
        }
        $cartItems = Cart::where('user_id',$userId)->where('is_order_placed',0)->get();
        $totalPrice = Cart::where('user_id',$userId)->where('is_order_placed',0)->sum('total_price');
        if ($cartItems->isEmpty()) {
            return response()->json(['message' => 'Your cart is empty'], 400);
        }
        $order = new Order();
        $order->user_id = $userId;
        $order->coupon_id =$discount_price!=0?$request->coupon_id:null;
        $order->address_id = $request->address_id;
        $order->status='pending';
        $order->created_at=now();
        $order->total_price = isset($request->coupon_id)?$totalPrice-$discount_price:$totalPrice;
        $order->save();
        $cartItemsToUpdate = [];
        foreach($cartItems as $eachItem)
        {

            $orderItem=new OrderItem();
            $orderItem->order_id=$order->id;
            $orderItem->product_id=$eachItem['product_id'];
            $orderItem->price=$eachItem['price'];
            $orderItem->quantity=$eachItem['quantity'];
            $orderItem->save();
            $cartItem=Cart::where('id',$eachItem['id'])->first();
            $cartItem->is_order_placed=1;
            $cartItemsToUpdate[] = $eachItem['id'];
        }
        Cart::whereIn('id', $cartItemsToUpdate)->update(['is_order_placed' => 1]);
        $couponUsed->status=1;
        $couponUsed->save();


        return response()->json(['message' => 'Order placed successfully']);
    }
}

