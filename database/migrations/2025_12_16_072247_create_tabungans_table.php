<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tabungans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nama_tabungan');
            $table->decimal('target_tabungan', 15, 2);
            $table->date('target_tanggal');
            $table->decimal('saldo_awal', 15, 2)->default(0);
            $table->decimal('saldo_terkini', 15, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tabungans');
    }
};