<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customer_shipping_method', function (Blueprint $table) {
            $table->increments('customer_shipping_method_id');
            $table->string('customer_id', 20);
            $table->unsignedInteger('shipping_method_id');
            $table->unsignedInteger('shipping_fee_unit_price_sales');
            $table->unsignedInteger('shipping_fee_unit_price_cost');
            $table->string('shipping_fee_note', 20)->nullable();
            $table->timestamps();
            // 外部キー制約
            $table->foreign('customer_id')->references('customer_id')->on('customers')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('shipping_method_id')->references('shipping_method_id')->on('shipping_methods')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_shipping_method');
    }
};
