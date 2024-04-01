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
        Schema::create('daftar_tarif_lembur', function (Blueprint $table) {
            $table->id();
            $table->string('entitas')->nullable();
            $table->string('basic');
            $table->string('level');
            $table->float('kjk')->nullable();
            $table->float('insidentil')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarif_lembur');
    }
};
