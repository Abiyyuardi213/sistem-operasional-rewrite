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
        Schema::create('dipo_kereta', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_dipo');
            $table->text('alamat')->nullable();
            $table->string('telepon')->nullable();
            $table->string('kepala_dipo')->nullable();
            $table->boolean('status');
            $table->timestamps();

            $table->uuid('kota_id');
            $table->uuid('daop_id');

            $table->foreign('kota_id')->references('id')->on('kota')->onDelete('cascade');
            $table->foreign('daop_id')->references('id')->on('daops')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dipo_kereta');
    }
};
