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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username');
            $table->string('password');
            $table->string('role'); // ADMIN, HRD, OPERATOR
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('admin')->nullable(); // ALL, SATU, DUA, GUDANG, TFI
            // auth akses ke administrasi
            $table->string('payroll')->nullable();
            $table->string('terlambat')->nullable();
            $table->string('bpjs')->nullable();
            $table->string('kupon')->nullable();
            $table->string('lembur')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
