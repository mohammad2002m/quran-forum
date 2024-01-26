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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table-> tinyText('email') -> nullable(false);
            $table-> tinyText('password') -> nullable(false);
            $table-> tinyText('name') -> nullable(false);
            $table-> tinyText('phone_number') -> nullable(false);
            $table-> enum('gender', ['ذكر', 'أنثى']) -> nullable(false);
            $table-> year('year') -> nullable(false);
            $table-> integer('parts_before') -> nullable(false);
            $table-> integer('parts') -> nullable(false);

            $table-> boolean('locked') -> nullable(false);
            $table-> boolean('can_be_teacher') -> nullable(false);
            $table-> boolean('first_login') -> nullable(false);
            $table-> boolean('tajweed_certificate') -> nullable(false);

            $table-> date('date');

            $table-> unsignedBigInteger('college_id') -> nullable(false);
            $table-> unsignedBigInteger('group_id') -> nullable(true);
            $table-> enum("status", ["active", "freezed", "stopped", "left"]) -> default("active") -> nullable(true);

            $table-> foreign('college_id') -> references('id') -> on('colleges') -> cascadeOnDelete() -> cascadeOnUpdate();
            //$table-> foreign('status_id') -> references('id') -> on('student_statuses') -> cascadeOnDelete() -> cascadeOnUpdate();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
