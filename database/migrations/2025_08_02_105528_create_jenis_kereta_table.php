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
        Schema::create('jenis_kereta', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('jenis')->unique();
            $table->string('tahun')->nullable();
            $table->string('kelas');
            $table->string('kecepatan_maks')->nullable();
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_kereta');
    }
};
