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
        Schema::create('administrasi_payrollrekap', function (Blueprint $table) {
            $table->id();
            $table->string('entitas')->nullable();
            $table->string('periode')->nullable();
            $table->date('dari')->nullable();
            $table->date('sampai')->nullable();
            $table->string('level')->nullable();
            $table->integer('jml_karyawan')->nullable();
            $table->integer('bruto')->nullable();
            $table->integer('koperasi')->nullable();
            $table->integer('infaq')->nullable();
            $table->integer('lainnya')->nullable();
            $table->integer('bpjs_tk')->nullable();
            $table->integer('bpjs_ks')->nullable();
            $table->integer('absensi')->nullable();
            $table->integer('tot_potongan')->nullable();
            $table->integer('netto')->nullable();
            $table->integer('locked')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administrasi_payrollrekap');
    }
};
