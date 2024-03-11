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
        Schema::create('balance_storages', function (Blueprint $table) {
            $table->increments('balance_storage_id');
            $table->unsignedInteger('balance_id');
            $table->integer('storage_sales')->default(0);
            $table->integer('storage_cost')->default(0);
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
        Schema::dropIfExists('balance_storages');
    }
};
