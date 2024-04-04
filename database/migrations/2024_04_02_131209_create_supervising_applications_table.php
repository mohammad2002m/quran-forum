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
        Schema::create('supervising_applications', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('notes') -> nullable(true);
            $table->enum('status', Constants::APPLICATION_STATUSES) -> nullable(false);
            $table->unsignedBigInteger('user_id') -> nullable(false);
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('max_responsibilities') -> nullable(false);
            $table->integer('applying_count') -> default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supervising_applications');
    }
};
