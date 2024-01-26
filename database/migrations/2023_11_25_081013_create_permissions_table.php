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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table-> unsignedBigInteger('role_id');
            $table-> unsignedBigInteger('activity_id');

            $table-> foreign('role_id') -> references('id') -> on('roles');
            $table-> foreign('activity_id') -> references('id') -> on('activities');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
