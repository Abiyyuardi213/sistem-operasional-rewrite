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
        Schema::create('resort', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('kategori_id');
            $table->string('nama_resort');
            $table->uuid('kota_id');
            $table->text('alamat')->nullable();
            $table->string('kepala_resort')->nullable();
            $table->string('telepon')->nullable();
            $table->timestamps();

            $table->foreign('kategori_id')->references('id')->on('kategori_resort')->onDelete('cascade');
            $table->foreign('kota_id')->references('id')->on('kota')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resort');
    }
};
