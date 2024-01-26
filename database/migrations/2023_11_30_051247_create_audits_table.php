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
        Schema::create('audits', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->json('old_value') -> nullable(true);
            $table->json('new_value') -> nullable(true);

            $table->tinyText('table_name') -> nullable(true);

            $table->unsignedBigInteger('log_id');

            $table->foreign('log_id') -> references('id') -> on('logs') -> cascadeOnDelete() -> cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audits');
    }
};
