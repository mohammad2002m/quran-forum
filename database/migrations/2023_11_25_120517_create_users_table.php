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
            $table-> enum('year', ['أولى', 'ثانية', 'ثالثة', 'رابعة', 'خامسة', 'سادسة', 'خريج']) -> nullable(false);
            $table-> enum("status", ["active", "freezed", "stopped", "left"]) -> default("active") -> nullable(true);

            $table-> tinyText('schedule') -> nullable(false);
            $table-> boolean('can_be_teacher') -> nullable(false);
            $table-> boolean('tajweed_certificate') -> nullable(false);

            $table-> boolean('locked') -> nullable(false);
            $table-> boolean('first_login') -> nullable(false);

            $table-> date('email_verified_at') -> nullable(true);

            $table-> unsignedBigInteger('college_id') -> nullable(false);
            $table-> unsignedBigInteger('group_id') -> nullable(true);

            $table->unsignedBigInteger('profile_image_id') -> nullable(true) -> default(1); // FIXME : add default image
            $table->unsignedBigInteger('cover_image_id') -> nullable(true) -> default(1);  // FIXME : add default image

            $table-> foreign('college_id') -> references('id') -> on('colleges');
            $table-> foreign('profile_image_id') -> references('id') -> on('images');
            $table-> foreign('cover_image_id') -> references('id') -> on('images');
            // group relationship was added inside cyclic_refercnes

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
