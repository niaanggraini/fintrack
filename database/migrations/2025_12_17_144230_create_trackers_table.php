<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('trackers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nama'); // "Tabung untuk konser"
            $table->decimal('target', 15, 2); // Target: 5.000.000
            $table->decimal('terkumpul', 15, 2)->default(0); // Yang udah terkumpul
            $table->date('tanggal_target'); // Deadline: 31 Jan 2026
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('trackers');
    }
};