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
        Schema::create('monthly_items', function (Blueprint $table) {
            $table->increments('monthly_item_id');
            $table->string('monthly_item_category_1', 20);
            $table->string('monthly_item_category_2', 20)->nullable();
            $table->string('monthly_item_name', 50);
            $table->string('monthly_item_note', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly_items');
    }
};
