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
        Schema::create('penerimaan_lamaran', function (Blueprint $table) {
            $table->id();
            $table->string('entitas');
            $table->string('nik');
            $table->index('nik');
            $table->string('stb')->nullable();
            $table->string('nama');
            $table->string('gender');
            $table->string('tempat');
            $table->date('tgllahir');
            $table->string('sekolah')->nullable();
            $table->string('pendidikan');
            $table->string('jurusan')->nullable();
            $table->longText('alamat')->nullable();
            $table->string('agama');
            $table->integer('tinggi');
            $table->decimal('berat', 10, 2);
            $table->string('notlp');
            $table->string('posisi');
            $table->string('email')->nullable();
            $table->longText('keterangan')->nullable();
            $table->integer('wawancara')->nullable();
            $table->integer('noformwawancara')->nullable();
            $table->integer('diterima')->nullable();
            $table->date('tglinput');
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
        Schema::dropIfExists('penerimaan_lamaran');
    }
};
