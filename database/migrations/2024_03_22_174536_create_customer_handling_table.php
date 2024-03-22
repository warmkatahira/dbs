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
        Schema::create('customer_handling', function (Blueprint $table) {
            $table->increments('customer_handling_id');
            $table->string('customer_id', 20);
            $table->unsignedInteger('handling_id');
            $table->unsignedInteger('handling_fee_unit_price');
            $table->string('handling_fee_note', 20)->nullable();
            $table->unsignedInteger('handling_sort_order')->default(999);
            $table->timestamps();
            // 外部キー制約
            $table->foreign('customer_id')->references('customer_id')->on('customers')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('handling_id')->references('handling_id')->on('handlings')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_handling');
    }
};
