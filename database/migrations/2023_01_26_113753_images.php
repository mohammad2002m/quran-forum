<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use QF\Constants;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('images', function ($table) {
            $table->id();
            $table->timestamps();
            $table->string('full_path') -> nullable(false);
            $table->boolean('stored') -> default(true);
            $table->enum('for', ['announcement', 'profile', 'cover']) -> default('announcement');
            $table->integer('width') -> nullable(false);
            $table->integer('height') -> nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
