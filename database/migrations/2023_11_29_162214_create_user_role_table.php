<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use QF\Constants;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_role', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table-> unsignedBigInteger('role_id') -> default(Constants::ROLE_STUDENT);
            $table-> unsignedBigInteger('user_id') -> nullable(false);

            //$table-> foreign('action_type_id') -> references('id') -> on('action_types') -> cascadeOnDelete() -> cascadeOnUpdate();
            $table-> foreign('role_id') -> references('id') -> on('roles') -> cascadeOnDelete() -> cascadeOnUpdate();
            $table-> foreign('user_id') -> references('id') -> on('users') -> cascadeOnDelete() -> cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_roles');
    }
};
