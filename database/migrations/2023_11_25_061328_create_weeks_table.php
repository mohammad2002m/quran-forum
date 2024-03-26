<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use QF\QuestionsAnswers;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('weeks', function (Blueprint $table) {
            $table-> id();
            $table-> timestamps();
            $table-> tinyText('name') -> nullable(false);
            $table-> date('start_date') -> nullable(false);
            $table-> date('end_date') -> nullable(false);
            $table-> enum('semester', QuestionsAnswers::WhatIsTheSemester) -> nullable(false);
            $table-> boolean('must') -> nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weeks');
    }
};
