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
        Schema::create('balance_shipping_fees', function (Blueprint $table) {
            $table->string('balance_shipping_fee_id', 25)->primary();
            $table->string('balance_id', 21);
            $table->unsignedInteger('shipping_method_id');
            $table->unsignedInteger('shipping_fee_quantity_sales')->default(0);
            $table->unsignedInteger('shipping_fee_unit_price_sales')->default(0);
            $table->unsignedInteger('shipping_fee_amount_sales')->default(0);
            $table->unsignedInteger('shipping_fee_quantity_cost')->default(0);
            $table->unsignedInteger('shipping_fee_unit_price_cost')->default(0);
            $table->unsignedInteger('shipping_fee_amount_cost')->default(0);
            $table->string('shipping_fee_note', 20)->nullable();
            $table->timestamps();
            // 外部キー制約
            $table->foreign('balance_id')->references('balance_id')->on('balances')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('shipping_method_id')->references('shipping_method_id')->on('shipping_methods')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balance_shipping_fees');
    }
};
