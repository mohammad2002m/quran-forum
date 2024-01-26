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
        /****** START  USER-GROUP ******/
        Schema::table('groups', function ($table) {
            $table-> foreign('supervisor_id') -> references('id') -> on('users') -> cascadeOnDelete() -> cascadeOnUpdate();
            $table-> foreign('monitor_id') -> references('id') -> on('users') -> cascadeOnDelete() -> cascadeOnUpdate();
            $table-> foreign('examiner_id') -> references('id') -> on('users') -> cascadeOnDelete() -> cascadeOnUpdate();
            $table-> foreign('tajweed_monitor_id') -> references('id') -> on('users') -> cascadeOnDelete() -> cascadeOnUpdate();
        });
        Schema::table('users', function ($table) {
            $table-> foreign('group_id') -> references('id') -> on('groups') -> cascadeOnDelete() -> cascadeOnUpdate();
        });
        /****** END USER GROUP ******/

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
