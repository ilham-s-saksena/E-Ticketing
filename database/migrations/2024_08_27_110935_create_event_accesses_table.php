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
        Schema::create('event_accesses', function (Blueprint $table) {
            $table->ulid()->primary();
            $table->foreignUlid('purchase_id')->references('id')->on('purchases');
            $table->string('qr');
            $table->boolean('isEntry')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_accesses');
    }
};