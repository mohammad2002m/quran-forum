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
        Schema::create('announcement_image', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            

            $table-> unsignedBigInteger('image_id') -> nullable(false);
            $table-> unsignedBigInteger('announcement_id') -> nullable(false);

            $table-> foreign('image_id')->references('id')->on('images') -> onDelete('cascade') -> onUpdate('cascade');
            $table-> foreign('announcement_id')->references('id')->on('announcements') -> onDelete('cascade') -> onUpdate('cascade');

            $table->boolean('is_main_image') -> default(false);
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcement_image');
    }
};
