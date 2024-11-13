<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponUsedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_useds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('coupon_id')->constrained('coupon_codes')->onDelete('cascade'); // Assumes `coupon_codes` is the coupons table
            $table->foreignId('order_id')->default(NULL); // Assumes `orders` is the orders table
            $table->date('used_date');
            $table->boolean('status')->default(0);
            $table->decimal('discount_price', 8, 2);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupon_useds');
    }
}
