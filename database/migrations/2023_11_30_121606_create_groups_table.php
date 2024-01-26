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
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->tinyText('name');
            $table->date('date');

            $table->unsignedBigInteger('supervisor_id');
            $table->unsignedBigInteger('monitor_id');
            $table->unsignedBigInteger('examiner_id');
            $table->unsignedBigInteger('tajweed_monitor_id');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('groups');
    }
};
