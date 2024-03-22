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
        Schema::create('monthly_cost_settings', function (Blueprint $table) {
            $table->increments('monthly_cost_setting_id');
            $table->string('base_id', 20);
            $table->date('monthly_cost_setting_ym');
            $table->unsignedInteger('ho_cost');
            $table->unsignedInteger('monthly_cost');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly_cost_settings');
    }
};
