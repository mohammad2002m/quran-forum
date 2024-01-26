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
        Schema::create('minutes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('meeting_number') -> unique();

            $table-> tinyText('place');
            $table-> tinyText('time');

            $table-> tinyText('title');

            $table-> mediumText('description');
            $table-> mediumText('attendees');

            $table-> mediumText('notes');
            $table-> date('date');

            $table-> unsignedBigInteger('writer_id');
            $table-> foreign('writer_id') -> references('id') -> on('users') -> cascadeOnDelete() -> cascadeOnUpdate();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('minutes');
    }
};
