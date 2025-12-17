<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('trackers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nama');
            $table->decimal('target', 15, 2);
            $table->decimal('terkumpul', 15, 2)->default(0);
            $table->date('tanggal_target');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trackers');
    }
};
