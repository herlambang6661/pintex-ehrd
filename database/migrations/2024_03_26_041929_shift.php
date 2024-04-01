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
        Schema::create('daftar_shift', function (Blueprint $table) {
            $table->id();
            $table->string('entitas')->nullable();
            $table->string('shift');
            $table->string('jenis');
            $table->time('in');
            $table->time('out');
            $table->string('keterangan');
            $table->time('in_rest');
            $table->time('out_rest');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shift');
    }
};
