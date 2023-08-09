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
        Schema::create('monthly_costs', function (Blueprint $table) {
            $table->increments('monthly_cost_id');
            $table->string('base_id', 20);
            $table->date('monthly_cost_ym');
            $table->unsignedInteger('monthly_cost_item_id');
            $table->unsignedInteger('monthly_cost');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly_costs');
    }
};
