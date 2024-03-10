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

            $table->tinyText('name') -> nullable(false);
            $table->enum("gender", ['ذكور', 'إناث']) -> nullable(false);

            $table->unsignedBigInteger('supervisor_id') -> nullable(true);
            $table->unsignedBigInteger('monitor_id') -> nullable(true);
            $table->unsignedBigInteger('examiner_id') -> nullable(true);
            $table->unsignedBigInteger('tajweed_monitor_id') -> nullable(true);


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
