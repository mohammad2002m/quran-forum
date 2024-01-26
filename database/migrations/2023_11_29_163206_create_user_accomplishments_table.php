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
        Schema::create('user_accomplishments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->date('date');

            $table-> unsignedBigInteger('user_id') -> nullable(false);
            $table-> unsignedBigInteger('accomplishment_id') -> nullable(false);

            $table-> foreign('user_id') -> references('id') -> on('users') -> cascadeOnDelete() -> cascadeOnUpdate();
            $table-> foreign('accomplishment_id') -> references('id') -> on('accomplishments') -> cascadeOnDelete() -> cascadeOnUpdate();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_accomplishments');
    }
};
