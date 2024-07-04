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
        Schema::create('administrasi_lembur', function (Blueprint $table) {
            $table->id();
            $table->string('entitas')->nullable();
            $table->integer('spl')->nullable();
            $table->string('tanggal')->nullable();
            $table->string('stb')->nullable();
            $table->string('nama')->nullable();
            $table->dateTime('in')->nullable();
            $table->dateTime('out')->nullable();
            $table->string('qty_jam')->nullable();
            $table->string('grup')->nullable();
            $table->string('bagian')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('diperintah')->nullable();
            $table->string('mengetahui')->nullable();
            $table->integer('status')->nullable();
            $table->string('dibuat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administrasi_lembur');
    }
};
