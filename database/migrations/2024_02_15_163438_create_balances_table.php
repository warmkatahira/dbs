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
        Schema::create('balances', function (Blueprint $table) {
            $table->string('balance_id', 21)->primary();
            $table->string('customer_id', 20);
            $table->date('balance_date');
            $table->integer('sales')->default(0);
            $table->integer('cost')->default(0);
            $table->integer('profit')->default(0);
            $table->string('note', 50)->nullable();
            $table->unsignedInteger('last_updated_user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balances');
    }
};
