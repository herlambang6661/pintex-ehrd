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
        Schema::create('administrasi_tunjanganhariraya', function (Blueprint $table) {
            $table->id();
            $table->string('entitas')->nullable();
            $table->string('periode')->nullable();
            $table->date('tanggal_thr')->nullable();
            $table->date('tgl_masuk')->nullable();
            $table->string('userid')->nullable();
            $table->string('stb')->nullable();
            $table->string('nama')->nullable();
            $table->string('level')->nullable();
            $table->string('divisi')->nullable();
            $table->string('bagian')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('grup')->nullable();
            $table->string('profesi')->nullable();
            $table->string('shift')->nullable();
            $table->integer('umr')->nullable();
            $table->integer('gapok')->nullable();
            $table->string('bank')->nullable();
            $table->string('rekening')->nullable();
            $table->integer('lembur')->nullable();
            $table->integer('tjabat')->nullable();
            $table->integer('prestasi')->nullable();
            $table->string('status')->nullable();
            $table->integer('locked')->nullable();
            $table->integer('printed')->nullable();
            $table->integer('print_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administrasi_tunjanganhariraya');
    }
};
