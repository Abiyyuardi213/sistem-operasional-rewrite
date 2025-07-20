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
        Schema::create('daops', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_daop')->unique();
            $table->text('deskripsi')->nullable();
            $table->string('alamat')->nullable();
            $table->string('telepon')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daops');
    }
};
