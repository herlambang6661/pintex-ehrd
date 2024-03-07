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
        Schema::create('penerimaan_karyawan', function (Blueprint $table) {
            $table->id();
            $table->string('entitas');
            $table->string('userid')->nullable();
            $table->string('nik');
            $table->string('nama');
            $table->string('gender');
            $table->string('tempat');
            $table->date('tgllahir');
            $table->string('pendidikan');
            $table->string('jurusan')->nullable();
            $table->longText('alamat')->nullable();
            $table->string('agama');
            $table->integer('tinggi');
            $table->decimal('berat', 10, 2);
            $table->string('notlp');
            $table->string('email')->nullable();
            $table->date('tglmasuk')->nullable();
            $table->date('tglaktif')->nullable();
            $table->date('tglkeluar')->nullable();
            $table->integer('gapok');
            $table->string('nomap')->nullable();
            $table->string('level')->nullable();
            $table->string('divisi')->nullable();
            $table->string('bagian')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('grup')->nullable();
            $table->string('profesi')->nullable();
            $table->string('shift')->nullable();
            $table->string('hrlibur')->nullable();
            $table->string('sethari')->nullable();
            $table->string('perjanjian')->nullable();
            $table->date('tglinternal')->nullable();
            $table->string('internal')->nullable();
            $table->string('status')->nullable();
            $table->string('serikat')->nullable();
            $table->integer('tjabat')->nullable();
            $table->integer('sptp')->nullable();
            $table->string('banknm')->nullable();
            $table->string('bankrek')->nullable();
            $table->integer('bpjs_jkk')->nullable();
            $table->integer('bpjs_jkm')->nullable();
            $table->integer('bpjs_jp')->nullable();
            $table->integer('bpjs_jht')->nullable();
            $table->integer('bpjs_ks')->nullable();
            $table->integer('bpjs_ksAdd')->nullable();
            $table->string('keterangan')->nullable();
            $table->date('tglinput')->nullable();
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
        Schema::dropIfExists('penerimaan_karyawan');
    }
};
