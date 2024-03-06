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
        Schema::create('penerimaan_wawancara', function (Blueprint $table) {
            $table->id();
            $table->string('idlamaran');
            $table->string('noform');
            $table->string('nama');
            $table->date('tglwawancara');
            $table->string('user')->nullable();
            $table->integer('diterima')->nullable();
            $table->integer('butawarna')->nullable();
            $table->integer('sikapbaik')->nullable();
            $table->integer('laricepat')->nullable();
            $table->longText('keterangan')->nullable();
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
        Schema::dropIfExists('penerimaan_wawancara');
    }
};
