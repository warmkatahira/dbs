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
        Schema::create('balance_labor_costs', function (Blueprint $table) {
            $table->increments('balance_labor_cost_id');
            $table->unsignedInteger('balance_id');
            $table->integer('fulltime_labor_cost')->default(0);
            $table->integer('contract_labor_cost')->default(0);
            $table->integer('parttime_labor_cost')->default(0);
            $table->integer('temporary_labor_cost')->default(0);
            $table->timestamps();
            // 外部キー制約
            $table->foreign('balance_id')->references('balance_id')->on('balances')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balance_labor_costs');
    }
};
