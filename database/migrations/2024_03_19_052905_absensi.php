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
        Schema::create('absensi_absensi', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('userid');
            $table->index('userid');
            $table->string('stb');
            $table->string('name');
            $table->dateTime('in')->nullable();
            $table->dateTime('out')->nullable();
            $table->integer('qj')->nullable();
            $table->integer('jis')->nullable();
            $table->integer('qjnet')->nullable();
            $table->string('prediksiShift')->nullable();
            $table->string('hrlibur')->nullable();
            $table->string('sethari')->nullable();
            $table->string('sst')->nullable();
            $table->string('raw_sst')->nullable();
            $table->string('grup')->nullable();
            $table->string('shift')->nullable();
            $table->string('bagian')->nullable();
            $table->string('keteranganLibur')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi_absensi');
    }
};
