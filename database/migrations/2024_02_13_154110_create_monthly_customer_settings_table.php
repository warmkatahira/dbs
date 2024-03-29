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
        Schema::create('monthly_customer_settings', function (Blueprint $table) {
            $table->increments('monthly_customer_setting_id');
            $table->string('customer_id', 20);
            $table->date('monthly_customer_setting_ym');
            $table->unsignedInteger('monthly_storage_sales')->default(0);
            $table->unsignedInteger('monthly_storage_cost')->default(0);
            $table->unsignedInteger('ho_cost_allocation_ratio')->default(0);
            $table->unsignedInteger('monthly_cost_allocation_ratio')->default(0);
            $table->boolean('balance_create_is_available')->default(1);
            $table->timestamps();
            // 外部キー制約
            $table->foreign('customer_id')->references('customer_id')->on('customers')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly_customer_settings');
    }
};
