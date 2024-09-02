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
        Schema::create('organizations', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('name', 250);
            $table->string('photo', 250);
            $table->text('description');
            $table->string('cp_name', 250);
            $table->string('cp_phone', 20);
            $table->text('address');
            $table->enum('isVerify', ['unverify', 'pending', 'verify'])->default('unverify');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
