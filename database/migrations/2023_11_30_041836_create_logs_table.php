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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table-> unsignedBigInteger('action_id') -> nullable(false);
            $table-> unsignedBigInteger('user_id') -> nullable(false);
            
            $table-> foreign('user_id') -> references('id') -> on('users') -> cascadeOnDelete() -> cascadeOnUpdate();
            $table-> foreign('action_id') -> references('id') -> on('actions') -> cascadeOnDelete() -> cascadeOnUpdate();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
