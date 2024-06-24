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
        Schema::create('absensi_komunikasi', function (Blueprint $table) {
            $table->id();
            $table->string('entitas');
            $table->string('noform');
            $table->date('tanggal');
            $table->string('dibuat');
            $table->string('keteranganform')->nullable();
            $table->timestamps();
        });

        Schema::create('absensi_komunikasiitm', function (Blueprint $table) {
            $table->id();
            $table->string('entitas');
            $table->string('noform');
            $table->date('tanggal');
            $table->date('tanggalw2')->nullable();
            $table->string('userid')->nullable();
            $table->string('nama')->nullable();
            $table->string('suratid')->nullable();
            $table->string('sst')->nullable();
            $table->string('statussurat')->nullable();
            $table->string('ket_acc')->nullable();
            $table->string('keterangan')->nullable();
            $table->integer('cron')->nullable();
            $table->string('dibuat')->nullable();
            $table->timestamps();
        });

        Schema::create('absensi_komunikasiacc', function (Blueprint $table) {
            $table->id();
            $table->string('entitas');
            $table->string('noform');
            $table->date('tanggal');
            $table->date('tanggal2')->nullable();
            $table->string('userid')->nullable();
            $table->string('nama')->nullable();
            $table->string('suratid')->nullable();
            $table->string('sst')->nullable();
            $table->string('statussurat')->nullable();
            $table->string('ket_acc')->nullable();
            $table->string('keterangan')->nullable();
            $table->integer('cron')->nullable();
            $table->string('dibuat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi_komunikasi');
        Schema::dropIfExists('absensi_komunikasiitm');
        Schema::dropIfExists('absensi_komunikasiacc');
    }
};
