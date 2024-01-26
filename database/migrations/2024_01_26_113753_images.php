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
        Schema::create('images', function ($table) {
            $table->id();
            $table->timestamps();
            $table->string('original_file_name') -> nullable(false);
            $table->string('full_path') -> nullable(false);
            $table->boolean('is_main_image') -> default(false) -> nullable(false);

            $table-> unsignedBigInteger('announcement_id') -> nullable(false);
            $table->foreign('announcement_id') -> references('id') -> on('announcements');
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
