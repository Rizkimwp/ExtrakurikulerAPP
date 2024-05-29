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
        Schema::create('extrakurikulers', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('deskripsi');
            $table->string('gambar')->nullable();
            $table->string('hari')->nullable(); // Kolom untuk menyimpan hari dalam minggu (e.g., 'Monday', 'Wednesday')
            $table->time('time')->nullable(); // Kolom untuk menyimpan waktu aktivitas (e.g., '14:00:00')
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('extrakurikulers');
    }
};