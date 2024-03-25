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
        Schema::create('delivery_companies', function (Blueprint $table) {
            $table->string('delivery_company_id', 20)->primary();
            $table->string('delivery_company_name', 20);
            $table->string('company_image', 20)->nullable();
            $table->unsignedInteger('delivery_company_sort_order');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_companies');
    }
};
