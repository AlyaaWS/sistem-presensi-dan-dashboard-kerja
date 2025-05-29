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
         Schema::create('presensis', function (Blueprint $table) {
            $table->id('id_presensi');
            $table->date('date');
            $table->time('time');
            $table->string('location');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_schedule'); // ditambahkan
         });
     }

     /**
      * Reverse the migrations.
      */
     public function down(): void
     {
         Schema::dropIfExists('presensis');
     }
};
