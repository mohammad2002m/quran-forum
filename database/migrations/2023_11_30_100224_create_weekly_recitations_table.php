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
        Schema::create('weekly_recitations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            
            $table-> integer('memorized_pages') -> nullable(false);
            $table-> integer('repeated_pages') -> nullable(false);
            
            $table-> tinyInteger('tajweed_mark') -> nullable(false);
            $table-> tinyInteger('memorization_mark') -> nullable(false);

            $table-> tinyText('notes');

            $table-> unsignedBigInteger('user_id') -> nullable(false);
            $table-> unsignedBigInteger('week_id') -> nullable(false);

            $table-> foreign('user_id') -> references('id') -> on('users') -> cascadeOnDelete() -> cascadeOnUpdate();
            $table-> foreign('week_id') -> references('id') -> on('weeks') -> cascadeOnDelete() -> cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weekly_recitations');
    }
};
