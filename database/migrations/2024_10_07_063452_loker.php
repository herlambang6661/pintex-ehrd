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
        Schema::create('penerimaan_lowongan', function (Blueprint $table) {
            $table->id();
            $table->string('image')->charset('binary');
            $table->string('entitas')->nullable();
            $table->tinyInteger('unlimited')->nullable();
            $table->date('tgl_buka')->nullable();
            $table->date('tgl_tutup')->nullable();
            $table->string('posisi');
            $table->string('pendidikan]');
            $table->tinyInteger('sima')->nullable();
            $table->tinyInteger('simb')->nullable();
            $table->tinyInteger('simb2')->nullable();
            $table->tinyInteger('sio')->nullable();
            $table->longText('deskripsi')->charset('binary');
            $table->string('release')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penerimaan_lowongan');
    }
};
