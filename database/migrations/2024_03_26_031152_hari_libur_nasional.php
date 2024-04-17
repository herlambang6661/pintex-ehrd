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
        Schema::create('daftar_hari_libur_nasional', function (Blueprint $table) {
            $table->id();
            $table->string('entitas')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('tahun')->nullable();
            $table->integer('id_nasional')->nullable();
            $table->string('libur_nasional')->nullable();
            $table->string('sumber_ketentuan')->nullable();
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hari_libur_nasional');
    }
};
