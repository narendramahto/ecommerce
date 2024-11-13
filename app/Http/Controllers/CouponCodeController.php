<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CouponCode;
use App\Models\CouponRule;
use App\Models\CouponUsed;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponCodeController extends Controller
{
    //
    public function couponList(Request $request)
    {
        $user_id=Auth::user()->id;
        $orderPrice=Cart::where('user_id',Auth::user()->id)->where('is_order_placed',0)->sum('total_price');
        $couponList=CouponCode::where('start_date','<=',now())->where('expiry_date','>',now())->get();
        $validCoupons=[];
        foreach($couponList as $eachCoupon)
        {
            $couponUsedByUser=CouponUsed::where('user_id',$user_id)->where('coupon_id',$eachCoupon['id'])->where('status',1)->count();
            $couponUsedTotal=CouponUsed::where('coupon_id',$eachCoupon['id'])->where('status',1)->count();
            $orderAmount=CouponRule::where('coupon_id',$eachCoupon['id'])->pluck('min_order_amount');
            if($couponUsedByUser<$eachCoupon['max_usage_limit'] && $couponUsedTotal<$eachCoupon['user_usage_limit'] && $orderAmount>=$eachCoupon['min_order_amount'])
            {
                $validCoupons[]=$eachCoupon;
            }
        }   
        return response()->json([
            'success' => true,
            'data' => $validCoupons
            ], 200);
    }

    public function checkout(Request $request)
    {
        $couponApplied=CouponCode::where('id',$request->coupon_id)->first();
        $couponUsed=CouponUsed::where('user_id',Auth::user()->id)->where("coupon_id",$request->coupon_id)->first();
        if($couponUsed==null){
            $couponUsed=new CouponUsed();
        }
        $couponUsed->coupon_id=$request->coupon_id;
        $couponUsed->user_id=Auth::user()->id;
        $couponUsed->used_date=now();
        $couponUsed->discount_price=(float)$couponApplied->discount_price;
        $couponUsed->status=0;
        $couponUsed->save();
        $address=UserAddress::where('user_id',Auth::user()->id)->get();
        return response()->json([
            'success' => true,
            'couponApplied' => $couponApplied,
            'address'=>$address
            ], 200);

    }
}
