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
            $table->unsignedInteger('monthly_storage_sales')->nullable();
            $table->unsignedInteger('monthly_storage_cost')->nullable();
            $table->unsignedInteger('working_days')->nullable();
            $table->boolean('is_available');
            $table->unsignedInteger('customer_sort_order');
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
