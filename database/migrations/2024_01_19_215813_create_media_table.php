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
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('original_file_name') -> nullable(false);
            $table->string('path') -> nullable(false);
            $table->enum('type', ['image', 'video']) -> nullable(false);
            $table->boolean('thumbnail') -> default(false) -> nullable(false);

            $table-> unsignedBigInteger('announcement_id') -> nullable(false);
            $table->foreign('announcement_id') -> references('id') -> on('announcements');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
