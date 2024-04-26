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
        Schema::create('administrasi_payrolldtl', function (Blueprint $table) {
            $table->id();
            $table->string('periode')->nullable();
            $table->string('stb')->nullable();
            $table->string('nama')->nullable();
            $table->string('jenis')->nullable();
            $table->integer('nominal')->nullable();
            $table->string('dibuat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administrasi_payrolldtl');
    }
};
