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
        Schema::create('penerimaan_legalitas', function (Blueprint $table) {
            $table->id();
            $table->string('suratjns');
            $table->string('userid')->nullable();
            $table->string('stb')->nullable();
            $table->string('nama');
            $table->date('inputtgl')->nullable();
            $table->date('legalitastgl')->nullable();
            $table->date('tglmasuk')->nullable();
            $table->date('tglaw')->nullable();
            $table->date('tglak')->nullable();
            $table->date('tglcuti_aw')->nullable();
            $table->date('tglcuti_ak')->nullable();
            $table->string('nmsurat')->nullable();
            $table->string('suratket')->nullable();
            $table->string('divisi')->nullable();
            $table->string('bagian')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('grup')->nullable();
            $table->string('profesi')->nullable();
            $table->string('shift')->nullable();
            $table->string('hrlibur')->nullable();
            $table->string('sethari')->nullable();
            $table->string('sacuti')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('id_cron')->nullable();
            $table->string('dibuat')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penerimaan_legalitas');
    }
};
