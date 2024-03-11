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
        Schema::create('balance_monthly_costs', function (Blueprint $table) {
            $table->increments('balance_monthly_cost_id');
            $table->string('balance_id', 21);
            $table->integer('ho_cost')->default(0);
            $table->integer('monthly_cost')->default(0);
            $table->timestamps();
            // 外部キー制約
            $table->foreign('balance_id')->references('balance_id')->on('balances')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balance_monthly_costs');
    }
};
