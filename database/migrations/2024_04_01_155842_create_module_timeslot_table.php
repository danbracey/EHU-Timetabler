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
        Schema::create('module_timeslot', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('module_id');
            $table->string('room_id');
            $table->tinyInteger('day_of_week');
            $table->time('start_time');
            $table->time('end_time');
            $table->boolean('is_lecture');
            $table->timestamps();

            $table->foreign('module_id')->references('id')->on('modules');
            $table->foreign('room_id')->references('id')->on('rooms');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('module_timeslot', function (Blueprint $table) {
            $table->dropForeign(['module_id']);
            $table->dropForeign(['room_id']);
        });

        Schema::dropIfExists('module_timeslot');
    }
};
