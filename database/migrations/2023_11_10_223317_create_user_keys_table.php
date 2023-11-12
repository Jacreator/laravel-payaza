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
        Schema::create('user_keys', function (Blueprint $table) {
            $table->id();
            $table->string('secret');
            $table->string('key');
            $table->string('secret_value');
            $table->string('key_value');
            $table->string('user_agent');
            $table->string('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_keys');
    }
};
