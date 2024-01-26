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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->mediumText('text') -> nullable(false);
            $table->date('date');
            $table->boolean('seen');

            $table-> unsignedBigInteger('sender_id') -> nullable(false);
            $table-> unsignedBigInteger('receiver_id') -> nullable(false);

            $table-> foreign('sender_id') -> references('id') -> on('users') -> cascadeOnDelete() -> cascadeOnUpdate();
            $table-> foreign('receiver_id') -> references('id') -> on('users') -> cascadeOnDelete() -> cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
