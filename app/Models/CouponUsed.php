<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CouponUsed extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'coupon_id',
        'used_date',
        'discount_price',
        'user_id'
    ];

    public function coupon()
    {
        return $this->belongsTo(CouponCode::class, 'coupon_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}

