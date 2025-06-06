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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id('id_schedule');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('active_day');
            $table->integer('scan_limit');
            $table->string('location');
            $table->string('qr_token')->nullable();
            $table->timestamp('token_expired_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
