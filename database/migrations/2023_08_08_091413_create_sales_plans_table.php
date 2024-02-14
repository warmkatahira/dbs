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
        Schema::create('sales_plan_settings', function (Blueprint $table) {
            $table->increments('sales_plan_setting_id');
            $table->string('base_id', 20);
            $table->date('sales_plan_setting_ym');
            $table->unsignedInteger('sales_plan_setting');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_plan_settings');
    }
};
