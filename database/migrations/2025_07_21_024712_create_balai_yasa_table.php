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
        Schema::create('balai_yasa', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_balai')->unique();
            $table->uuid('kota_id');
            $table->text('deskripsi')->nullable();
            $table->text('alamat');
            $table->string('telepon')->nullable();
            $table->string('kepala_balai')->nullable();
            $table->boolean('status');
            $table->timestamps();

            $table->foreign('kota_id')->references('id')->on('kota')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balai_yasa');
    }
};
