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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->tinyInteger('memorize_mark') -> nullable(true);
            $table->tinyInteger('tajweed_mark') -> nullable(true);

            $table->tinyInteger('wait_date') -> nullable(false); // the date in which the exam was avaiable to be done and should be done
            $table->tinyInteger('exam_date') -> nullable(true);

            $table->boolean('is_supervising') -> nullable(false);
            $table->integer('parts') -> nullable(true);


            $table-> unsignedBigInteger('user_id') -> nullable(false);

            $table-> foreign('user_id') -> references('id') -> on('users') -> cascadeOnDelete() -> cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
