<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CouponCode extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'coupon_name',
        'coupon_code',
        'start_date',
        'expiry_date',
        'discount_amount',
        'max_usage_limit',
        'user_usage_limit',
        'description',
    ];
    public function couponRules()
    {
        return $this->hasMany(CouponRule::class, 'coupon_id');
    }

}
