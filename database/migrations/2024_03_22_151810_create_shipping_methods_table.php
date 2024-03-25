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
        Schema::create('shipping_methods', function (Blueprint $table) {
            $table->increments('shipping_method_id');
            $table->string('delivery_company_id', 20);
            $table->string('shipping_method_name', 20);
            $table->unsignedInteger('shipping_method_sort_order');
            $table->timestamps();
            // 外部キー制約
            $table->foreign('delivery_company_id')->references('delivery_company_id')->on('delivery_companies')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_methods');
    }
};
