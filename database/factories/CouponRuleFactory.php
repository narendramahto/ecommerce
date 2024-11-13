<?php

namespace Database\Factories;

use App\Models\CouponRule;
use App\Models\CouponCode;
use Illuminate\Database\Eloquent\Factories\Factory;

class CouponRuleFactory extends Factory
{
    protected $model = CouponRule::class;

    public function definition()
    {
        return [
            'coupon_id' => CouponCode::factory(), // Automatically creates a CouponCode if not provided
            'min_order_amount' => $this->faker->numberBetween(50, 200),
        ];
    }
}

