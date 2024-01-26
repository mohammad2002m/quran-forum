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
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->tinyText('title') -> nullable(false);
            $table->mediumText('description') -> nullable(false);
            $table->date('date') -> nullable(false);
            $table->tinyText('status') -> nullable(false);

            $table->unsignedBigInteger('type_id') -> nullable(false);
            $table->unsignedBigInteger('user_id') -> nullable(false);

            $table-> foreign('user_id') -> references('id') -> on('announcement_types') -> cascadeOnDelete() -> cascadeOnUpdate();
            $table-> foreign('type_id') -> references('id') -> on('announcement_types') -> cascadeOnDelete() -> cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
