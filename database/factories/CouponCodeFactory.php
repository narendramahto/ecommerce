<?php

namespace Database\Factories;

use App\Models\CouponCode;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CouponCodeFactory extends Factory
{
    protected $model = CouponCode::class;

    public function definition()
    {
        return [
            'coupon_name' => $this->faker->words(2, true),
            'coupon_code' => strtoupper(Str::random(8)),
            'start_date' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'expiry_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'discount_amount' => $this->faker->numberBetween(10, 50),
            'max_usage_limit' => $this->faker->numberBetween(1, 100),
            'user_usage_limit' => $this->faker->numberBetween(1, 10),
            'description' => $this->faker->sentence(),
        ];
    }
}

