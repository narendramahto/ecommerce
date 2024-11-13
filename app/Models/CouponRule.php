<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CouponRule extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'coupon_id',
        'min_order_amount',
    ];

    // Define the relationship to CouponCode
    public function coupon()
    {
        return $this->belongsTo(CouponCode::class);
    }
}
