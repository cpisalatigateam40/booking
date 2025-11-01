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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('name');
            $table->string('email');
            $table->uuid('department_uuid');
            $table->uuid('room_uuid');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->longText('description');
            $table->string('status');
            $table->timestamps();

            $table->foreign('department_uuid')->references('uuid')->on('departments');
            $table->foreign('room_uuid')->references('uuid')->on('rooms');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
