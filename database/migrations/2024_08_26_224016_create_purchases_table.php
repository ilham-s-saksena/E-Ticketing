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
        Schema::create('purchases', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('ticket_id')->references('id')->on('tickets');
            $table->foreignUlid('buyer_id')->nullable();
            $table->integer('qty');
            $table->string('token', 250);
            $table->enum('status', ['unpaid', 'paid', 'experied'])->default('unpaid');
            $table->boolean('isSended')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
