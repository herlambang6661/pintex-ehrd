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
            $table->string('admin')->nullable(); // ALL : Semua bagian, 1 : Unit 1, 2 : Unit 2, 3 : Gudang, 4 : TFI
            // auth akses ke administrasi
            $table->integer('payroll')->default(0);
            $table->integer('thr')->default(0);
            $table->integer('terlambat')->default(0);
            $table->integer('bpjs')->default(0);
            $table->integer('kupon')->default(0);
            $table->integer('lembur')->default(0);
            $table->integer('setting')->default(0);
            $table->integer('schedule')->default(0);
            $table->integer('logs')->default(0);
            $table->integer('pengguna')->default(0);
            $table->integer('daftar')->default(0);
            $table->integer('penerimaan')->default(0);
            $table->integer('lowongan')->default(0);
            $table->integer('lamaran')->default(0);
            $table->integer('wawancara')->default(0);
            $table->integer('karyawan')->default(0);
            $table->integer('legalitas')->default(0);
            $table->integer('absensi')->default(0);
            $table->integer('absen')->default(0);
            $table->integer('surat')->default(0);
            $table->integer('cuti')->default(0);
            $table->integer('administrasi')->default(0);
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
