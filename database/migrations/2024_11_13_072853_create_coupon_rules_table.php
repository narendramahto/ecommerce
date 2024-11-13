<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_rules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('coupon_id')->constrained('coupon_codes')->onDelete('cascade');
            $table->decimal('min_order_amount', 8, 2)->default(0); // Minimum order amount required to apply the coupon
            $table->softDeletes(); // For soft deletes
            $table->timestamps(); // Created at and updated at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupon_rules');
    }
}
