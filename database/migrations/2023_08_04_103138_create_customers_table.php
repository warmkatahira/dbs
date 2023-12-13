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
        Schema::create('customers', function (Blueprint $table) {
            $table->string('customer_id', 20)->primary();
            $table->string('base_id', 20);
            $table->string('customer_name', 20);
            $table->unsignedInteger('monthly_storage_sales')->default(0);
            $table->unsignedInteger('monthly_storage_cost')->default(0);
            $table->boolean('is_available');
            $table->unsignedInteger('customer_sort_order');
            $table->unsignedInteger('cost_allocation_ratio')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
