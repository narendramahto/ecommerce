<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_codes', function (Blueprint $table) {
            $table->id();
            $table->string('coupon_name');
            $table->string('coupon_code')->unique();
            $table->date('start_date');
            $table->date('expiry_date');
            $table->decimal('discount_amount', 8, 2);
            $table->integer('max_usage_limit')->default(0); // Max times the coupon can be used
            $table->integer('user_usage_limit')->default(1); // Max times a single user can use
            $table->text('description')->nullable();
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
        Schema::dropIfExists('coupon_codes');
    }
}
