<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporan', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 150);
            $table->string('lokasi', 100);
            $table->string('pelapor', 100)->default('Warga Desa');
            $table->decimal('luas_ha', 5, 2)->nullable();
            $table->enum('status', ['kritis', 'ditinjau', 'terkendali'])->default('ditinjau');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};
