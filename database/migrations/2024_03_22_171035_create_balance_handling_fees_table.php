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
        Schema::create('balance_handling_fees', function (Blueprint $table) {
            $table->string('balance_handling_fee_id', 25)->primary();
            $table->string('balance_id', 21);
            $table->string('handling_id', 8);
            $table->unsignedInteger('handling_fee_quantity')->default(0);
            $table->unsignedInteger('handling_fee_unit_price')->default(0);
            $table->unsignedInteger('handling_fee_amount')->default(0);
            $table->string('handling_fee_note', 20)->nullable();
            $table->timestamps();
            // 外部キー制約
            $table->foreign('balance_id')->references('balance_id')->on('balances')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('handling_id')->references('handling_id')->on('handlings')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balance_handling_fees');
    }
};
