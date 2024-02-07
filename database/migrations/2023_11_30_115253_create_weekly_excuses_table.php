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
        Schema::create('weekly_excuses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            
            $table-> mediumText('excuse') -> nullable(false);
            $table-> mediumText('notes');
            $table-> enum('status', ['pending', 'approved', 'rejected']) -> default('pending');

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
        Schema::dropIfExists('weekly_excuses');
    }
};
